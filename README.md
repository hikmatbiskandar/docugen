**Statementify** is a Laravel-based system for generating PDF statements based on database rows. It provides a simple and efficient way to create customized statements using a combination of HTML templates and data merging.

# Features:

- Generate PDF statements from database tables.
- Use HTML templates with merge tags to customize statement layouts.
- Pre-populate statement data based on database records.
- Support for signature integration.
- Easy to integrate with existing Laravel applications.

# How it works:

1. Create a new database table to store statement data.
2. Create an HTML template file with merge tags corresponding to your table's fields.
3. Use the Statementify API to generate a PDF statement from your template and table data.
4. View the generated PDF statement directly in your application or download it for further use.

# Installation:

1. Clone this repository.
2. Run the migration. It will create tables:

	`statements` - Your statements that can be exported as PDFs.
	`signatures` - List of images attached to the PDFs.
3. Place your html templates in `resources/views/html_templates` folder.


This is just a basic overview of Statementify's functionalities. For more detailed information on usage and configuration, please refer to the official documentation (coming soon).

# Contributing:

Feel free to contribute to Statementify by reporting bugs, suggesting features, or sending pull requests.

# License:

Statementify is licensed under the MIT License.
