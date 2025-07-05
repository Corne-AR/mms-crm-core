MMS Design CRM Scripts Launcher
===============================

Overview
--------
This project provides a graphical interface for launching utility scripts that assist
with various tasks in the MMS Design CRM environment. It is built using Python and Tkinter.

The interface (`main_ui.py`) dynamically loads scripts from the `scripts/` folder.
Each script appears as a button in the UI with a label and tooltip describing its purpose.

Folder structure
----------------
/mms_crm_tool/
├── main_ui.py             # The GUI launcher
├── README.txt             # This file
└── /scripts/              # Folder for your custom scripts
    ├── create_or_open_file.py
    └── build_master_v4.py

Usage
-----
1. Ensure Python 3.10+ is installed.
2. Launch the GUI app with:

       python main_ui.py

3. The window titled "MMS Design CRM scrips toolbox" opens with buttons for each script.
4. Hover over buttons to see tooltips; click to run the corresponding script.
5. Use the Help → README menu option to view this file from within the app.

Adding Scripts
--------------
1. Add a new Python script in the `scripts/` folder.
2. Ensure the main logic is inside a function (e.g., `def main():`) and not executed automatically.
3. Add an entry in the `SCRIPTS` list inside `main_ui.py` like:

       {
           "label": "Script Display Name",
           "tooltip": "Short description of what the script does",
           "module": "scripts.module_name",
           "function": "function_name"
       }

4. Save the changes and re-run `main_ui.py` to see the updated interface.

Best Practices
--------------
- Use `if __name__ == "__main__":` to avoid auto-running logic on import.
- Provide user feedback using `messagebox` dialogs.
- Keep scripts modular and avoid hardcoded paths outside of config sections.

Support
-------
This is an internal tool to simplify and automate file-based operations and maintenance
tasks for MMS Design CRM workflows. Refer to this README or your own documentation for help.

License
-------
MIT License © 2025 MMS Design
