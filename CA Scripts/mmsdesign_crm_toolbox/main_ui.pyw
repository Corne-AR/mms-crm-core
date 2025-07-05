"""
MMS Design CRM Scripts UI
-------------------------
A modular Tkinter-based launcher for Python scripts, structured for use in a
Visual Studio Code workspace. Scripts are stored in a dedicated `scripts/`
folder and referenced dynamically from the main interface.

Window:
    • Title: "MMS Design CRM scrips toolbox"
    • Initial size: 600×400 px, resizable
"""

import os
import sys
import subprocess
import tkinter as tk
from tkinter import ttk, messagebox
from importlib import import_module

ICON_PATH = r"C:\xampp\htdocs\mms-crm-core\public\favicon.ico"

# ---------------------------------------------------------------------------
# Script Registry (Dynamic import from scripts folder)
# ---------------------------------------------------------------------------

SCRIPTS = [
    {
        "label": "Create / Check File",
        "tooltip": (
            "Creates an empty file at the supplied path if it does not exist, "
            "or opens the existing file for inspection."
        ),
        "module": "scripts.create_or_open_file",
        "function": "create_or_open_file",
    },
    {
        "label": "Build Master",
        "tooltip": (
            "This script generates a single master snapshot of the MMS CRM project, "
            "including all .php, .json files and the .env file."
        ),
        "module": "scripts.build_master_v4",
        "function": "main",
    },

    {
    "label": "Export Directory Structure",
    "tooltip": (
        "This script scans a selected folder and generates a text file "
        "listing all folders and their contents in a level-by-level layout."
    ),
    "module": "scripts.export_directory_structure",
    "function": "export_directory_structure",
},

]

# ---------------------------------------------------------------------------
# Dynamic import utility
# ---------------------------------------------------------------------------

def load_script_function(module_name: str, function_name: str):
    try:
        mod = import_module(module_name)
        return getattr(mod, function_name)
    except Exception as exc:
        def fallback(exc=exc):
            messagebox.showerror(
                "Script Error",
                f"Failed to load {module_name}.{function_name}\n{exc}",
            )
        return fallback

# ---------------------------------------------------------------------------
# Main application
# ---------------------------------------------------------------------------

class App(tk.Tk):
    def __init__(self) -> None:
        super().__init__()
        self.title("MMS Design CRM scrips toolbox")
        self.geometry("600x400")
        self.minsize(400, 300)
        self.configure(padx=10, pady=10)

        # Try setting icon if file exists
        if os.path.exists(ICON_PATH):
            try:
                self.iconbitmap(ICON_PATH)
            except Exception as e:
                print(f"Could not set icon: {e}")

        self._create_menu()
        self._create_widgets()

    def _create_menu(self) -> None:
        menubar = tk.Menu(self)
        helpmenu = tk.Menu(menubar, tearoff=0)
        helpmenu.add_command(label="Open README", command=self._open_readme)
        menubar.add_cascade(label="Help", menu=helpmenu)
        self.config(menu=menubar)

    def _open_readme(self) -> None:
        readme_path = os.path.join(
            os.path.dirname(os.path.abspath(__file__)),
            "README.txt",
        )
        if not os.path.isfile(readme_path):
            messagebox.showerror(
                "File Not Found",
                f"README.txt not found at:\n{readme_path}",
            )
            return
        try:
            if sys.platform.startswith("win"):
                os.startfile(readme_path)  # type: ignore[attr-defined]
            elif sys.platform == "darwin":
                subprocess.run(["open", readme_path], check=False)
            else:
                subprocess.run(["xdg-open", readme_path], check=False)
        except Exception as exc:
            messagebox.showerror("Error", f"Could not open README:\n{exc}")

    def _create_widgets(self) -> None:
        container = ttk.Frame(self)
        container.pack(fill="both", expand=True)
        container.rowconfigure(0, minsize=60)
        
        self.info_label = ttk.Label(
            container,
            text="",
            wraplength=550,
            justify="left",
            anchor="w",
        )
        self.info_label.grid(row=0, column=0, sticky="ew", pady=(0, 8))

        for idx, entry in enumerate(SCRIPTS, start=1):
            func = load_script_function(entry["module"], entry["function"])
            btn = ttk.Button(container, text=entry["label"], command=func)
            btn.grid(row=idx, column=0, sticky="ew", pady=0)
            btn.bind("<Enter>", lambda _e, txt=entry["tooltip"]: self.info_label.config(text=txt))
            btn.bind("<Leave>", lambda _e: self.info_label.config(text=""))

        container.grid_columnconfigure(0, weight=1)

if __name__ == "__main__":
    App().mainloop()
