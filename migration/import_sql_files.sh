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