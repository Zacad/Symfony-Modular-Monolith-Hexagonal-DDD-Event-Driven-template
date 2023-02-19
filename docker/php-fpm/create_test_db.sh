mysql -u root -pstoinastacjilokomotywa -h db -P 3306 -e 'create database test;'
echo 'dodaje usera db_user'
mysql -u root -pstoinastacjilokomotywa -h db -P 3306 -e "GRANT ALL ON test.* TO 'db_user';"