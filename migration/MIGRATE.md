# Database Migration Steps

## Step 1: Export the Old Database

Export the old database as separate SQL files for each table. Save these files in a zip archive.

## Step 2: Create a New Database

Create a new database where the data from the old database will be imported.

## Step 3: Run the Script to Delete Files with No "INSERT INTO"

Before importing the data, run a script to delete any SQL files that don't contain any `INSERT INTO` statements. This will prevent empty tables from being created in the new database.

Here's a sample script that can do this:

```bash
for file in *.sql; do
  if ! grep -q "INSERT INTO" "$file"; then
    rm "$file"
  fi
done
```
## Step 4: Run the Import Script

Finally, run a script to import the data from the SQL files into the new database.

Here's a sample import script:

```bash
DATABASE_NAME="old_jobboard_2"
USERNAME="root"
PASSWORD=""
DIRECTORY="C:/Users/Peter/Downloads/tables_small"
MYSQL_PATH="C:/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysql"

for SQL_FILE in $DIRECTORY/*.sql
do
  "$MYSQL_PATH" -u $USERNAME $DATABASE_NAME < $SQL_FILE && rm $SQL_FILE
  echo "Processed $SQL_FILE"
done
```
Many files need to have the `inserted` column default replaced with `CURRENT_TIMESTAMP`, and any row values for `DATETIME` columns like so `0000-00-00 00:00:00` will need to be replaced with `CURRENT_TIMESTAMP`. Some ENUMs also need altering like so:

```
ALTER TABLE `table_name`
MODIFY COLUMN column_name ENUM('Yes', 'No', '') NOT NULL DEFAULT 'Yes';
```

Here are the tables required:
```
['administrator', 'applicant_status', 'application', 'job_screener', 'application_screener', 'apply', 'article', 'company_description', 'cover_letters', 'job_alert_direct', 'job_post_images', 'jobadder_job', 'jobs', 'jobseeker', 'jobseeker_login', 'jobseeker_resume1', 'recruiter', 'recruiter_account_history', 'recruiter_login', 'recruiter_users', 'resume_alert', 'resume_downloads', 'save_job', 'save_resume']
```
Instructions for each table are, for the most part, in seaparte SQL files in this `migration` folder.

# Step 5: Import Process

Begin with Jobs table. Remove any create table commands for every script. Add the foollowing before each set of inserts:

```
# Disable foreign key checks
SET FOREIGN_KEY_CHECKS=0;
```

Add this after all Insert commands:

```
# Disable foreign key checks
SET FOREIGN_KEY_CHECKS=1;
```

Also remove any key setting at the end, like this:
```
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);
COMMIT;
```

Also check AUTOINCREMENT values if the table is unindexed.

# Each Import In Turn:
1. Jobs - remove `inserted` column. Drop `updated_at` and rename `updated` as updated_at