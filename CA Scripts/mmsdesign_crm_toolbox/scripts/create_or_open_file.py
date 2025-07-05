import os
import tkinter as tk
from tkinter import messagebox

# Root path WITHOUT trailing backslash – keeps os.path.join clean
ROOT_PATH = r"C:\xampp\htdocs\mms-crm-core"
ROOT_DISPLAY = ROOT_PATH + os.sep  # shown to the user when “//root” is chosen

SUBFOLDERS = [
    "app",
    "app/Filament",
    "app/Filament/Resources",
    "app/Filament/Resources/CustomerResource",
    "app/Filament/Resources/CustomerResource/Pages",
    "app/Filament/Resources/QuoteResource",
    "app/Filament/Resources/QuoteResource/Pages",
    "app/Filament/Resources/UserResource",
    "app/Filament/Resources/UserResource/Pages",
    "app/Helpers",
    "app/Http",
    "app/Http/Controllers",
    "app/Mail",
    "app/Models",
    "app/Providers",
    "app/Providers/Filament",
    "bootstrap",
    "bootstrap/cache",
    "config",
    "database",
    "database/factories",
    "database/migrations",
    "database/schema",
    "database/seeders",
    "docs",
    "Lovable Resources",
    "public",
    "public/css",
    "public/js",
    "public/js/filament",
    "resources",
    "resources/css",
    "resources/js",
    "resources/views",
    "resources/views/emails",
    "resources/views/layouts",
    "resources/views/partials",
    "routes",
    "storage"
]

class PathDialog(tk.Toplevel):
    def __init__(self, master: tk.Tk | None = None):
        super().__init__(master)
        self.title("File Path")
        self.resizable(False, True)
        self.grab_set()
        self.protocol("WM_DELETE_WINDOW", self._cancel)

        self.result: str | None = None

        # Entry for full path
        self.var = tk.StringVar(value=ROOT_DISPLAY)
        entry = tk.Entry(self, textvariable=self.var, width=80)
        entry.grid(row=0, column=0, columnspan=2, padx=10, pady=(10, 4), sticky="ew")
        entry.focus_set()

        # Listbox with scrollbar
        frame = tk.Frame(self)
        frame.grid(row=1, column=0, columnspan=2, padx=10, sticky="nsew")
        self.rowconfigure(1, weight=1)
        self.columnconfigure(0, weight=1)

        scrollbar = tk.Scrollbar(frame, orient="vertical")
        listbox = tk.Listbox(frame, height=12, yscrollcommand=scrollbar.set, selectmode="browse")
        scrollbar.config(command=listbox.yview)
        scrollbar.pack(side="right", fill="y")
        listbox.pack(side="left", fill="both", expand=True)
        # Populate list
        listbox.insert(tk.END, "//root")
        for sub in SUBFOLDERS:
            listbox.insert(tk.END, sub)

        def on_select(_event=None):
            sel = listbox.curselection()
            if not sel:
                return
            choice = listbox.get(sel[0])
            if choice == "//root":
                self.var.set(ROOT_DISPLAY)
            else:
                sub_path = choice.replace("/", os.sep)
                self.var.set(os.path.join(ROOT_PATH, sub_path) + os.sep)

        listbox.bind("<<ListboxSelect>>", on_select)

        # OK / Cancel buttons
        btn_ok = tk.Button(self, text="OK", width=10, command=self._ok)
        btn_cancel = tk.Button(self, text="Cancel", width=10, command=self._cancel)
        btn_ok.grid(row=2, column=0, pady=10, sticky="e", padx=(0, 5))
        btn_cancel.grid(row=2, column=1, pady=10, sticky="w", padx=(5, 10))

    def _ok(self):
        self.result = self.var.get().strip().strip('"')
        self.destroy()

    def _cancel(self):
        self.result = None
        self.destroy()


def create_or_open_file():
    dlg = PathDialog(tk._default_root)  # type: ignore[attr-defined]
    dlg.wait_window()
    path = dlg.result
    if not path:
        return

    path = os.path.expanduser(path.rstrip("\\/"))  # remove trailing slash before processing

    if os.path.exists(path):
        if messagebox.askyesno("File Exists", f"The file exists:\n{path}\n\nOpen it?"):
            _open_in_default_app(path)
    else:
        try:
            os.makedirs(os.path.dirname(path), exist_ok=True)
            with open(path, "w", encoding="utf-8") as f:
                f.write("")  # create an empty file
            messagebox.showinfo("File Created", f"Empty file created at:\n{path}")
            _open_in_default_app(path)
        except Exception as exc:
            messagebox.showerror("Error", f"Could not create file:\n{exc}")


def _open_in_default_app(path: str) -> None:
    try:
        os.startfile(path)  # type: ignore[attr-defined]
    except Exception as exc:
        messagebox.showwarning("Open Failed", f"Could not open file:\n{exc}")


if __name__ == "__main__":
    create_or_open_file()