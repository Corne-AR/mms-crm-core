import os
import tkinter as tk
from tkinter import filedialog, messagebox

def list_folders_level_by_level(root_dir):
    output_lines = []
    all_folder_paths = [root_dir]
    try:
        root_folders = [entry for entry in sorted(os.listdir(root_dir))
                        if os.path.isdir(os.path.join(root_dir, entry))]
    except Exception as e:
        return [], [], f"Failed to list root folder: {e}"

    output_lines.append("Root folders:")
    if root_folders:
        for folder in root_folders:
            output_lines.append(folder)
            all_folder_paths.append(os.path.join(root_dir, folder))
    else:
        output_lines.append("(No subfolders in root)")
    output_lines.append("")

    queue = [(os.path.join(root_dir, folder), folder) for folder in root_folders]

    while queue:
        next_queue = []
        for folder_path, parent_name in queue:
            try:
                subfolders = [entry for entry in sorted(os.listdir(folder_path))
                              if os.path.isdir(os.path.join(folder_path, entry))]
            except PermissionError:
                output_lines.append(f"Folders inside {parent_name}: [Permission Denied]")
                output_lines.append("")
                continue
            except Exception as e:
                output_lines.append(f"Folders inside {parent_name}: [Error: {e}]")
                output_lines.append("")
                continue

            if subfolders:
                output_lines.append(f"Folders inside {parent_name}:")
                for subfolder in subfolders:
                    output_lines.append(subfolder)
                    next_queue.append((os.path.join(folder_path, subfolder), subfolder))
                    all_folder_paths.append(os.path.join(folder_path, subfolder))
            else:
                output_lines.append(f"Folders inside {parent_name}:")
                output_lines.append("(No subfolders)")
            output_lines.append("")
        queue = next_queue

    return output_lines, all_folder_paths, None

def list_files_in_folders(folder_paths):
    output_lines = []
    output_lines.append("="*60)
    output_lines.append("Files in each folder:")
    output_lines.append("="*60)
    output_lines.append("")

    for folder in folder_paths:
        try:
            files = [entry for entry in sorted(os.listdir(folder))
                     if os.path.isfile(os.path.join(folder, entry))]
        except PermissionError:
            output_lines.append(f"{folder}: [Permission Denied]")
            output_lines.append("")
            continue
        except Exception as e:
            output_lines.append(f"{folder}: [Error: {e}]")
            output_lines.append("")
            continue

        output_lines.append(f"{folder}:")
        if files:
            for file in files:
                output_lines.append(f"    {file}")
        else:
            output_lines.append("    (No files)")
        output_lines.append("")
    return output_lines

def export_directory_structure():
    root = tk.Tk()
    root.withdraw()
    root.attributes('-topmost', True)

    messagebox.showinfo(
        "Folder Structure Exporter",
        "Click OK to select the root folder you want to scan.\n"
        "A file called 'directory_structure.txt' will be created in that folder."
    )

    root_dir = filedialog.askdirectory(title="Select the root folder to scan")
    if not root_dir:
        return

    messagebox.showinfo(
        "Scanning",
        f"Scanning '{root_dir}' for folders and files.\n\n"
        "This may take a while for large directories."
    )

    output_txt = os.path.join(root_dir, "directory_structure.txt")
    try:
        folder_lines, all_folder_paths, err = list_folders_level_by_level(root_dir)
        if err:
            messagebox.showerror("Error", err)
            return
    except Exception as e:
        messagebox.showerror("Error", f"An error occurred while scanning the folders:\n{str(e)}")
        return

    try:
        files_lines = list_files_in_folders(all_folder_paths)
    except Exception as e:
        messagebox.showerror("Error", f"An error occurred while listing files:\n{str(e)}")
        return

    try:
        with open(output_txt, "w", encoding="utf-8") as f:
            f.write("\n".join(folder_lines))
            f.write("\n")
            f.write("\n".join(files_lines))
    except Exception as e:
        messagebox.showerror("Error", f"Could not write to file:\n{output_txt}\n\n{str(e)}")
        return

    messagebox.showinfo(
        "Done",
        f"Directory structure and file lists were saved to:\n\n{output_txt}\n\n"
        "Click OK to open the file."
    )

    try:
        os.startfile(output_txt)
    except Exception:
        messagebox.showwarning(
            "Manual Open",
            f"Could not automatically open the file.\nPlease open it manually:\n{output_txt}"
        )
