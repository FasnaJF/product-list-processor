How To Run The Script?
======================
Important: PHP version required is ^8.0

1. As a first step, Install PHPUnit files via composer.

   To do that, Run the following command in the root folder

   ``composer install``

2. Run the script to test the input file in csv format

   ``sh script.sh``

3. To test for other file formats

   i. For TSV File, Replace the line in script.sh with the following and run the command ``sh script.sh``

   ``php parser.php --file products.tsv --unique-combinations=unique_combinations.csv --print_output=true``

   ii. For XML File, Replace the line in script.sh with the following and run the command ``sh script.sh``

   ``php parser.php --file products.xml --unique-combinations=unique_combinations.csv --print_output=true``

   iii. For JSON File, Replace the line in script.sh with the following and run the command ``sh script.sh``

   ``php parser.php --file products.json --unique-combinations=unique_combinations.csv --print_output=true``

   To add your own test cases, you can add them, in the inputs folder. Then, change the forth parameter with the file name in above command.

4. To disable printing on the terminal, you can set the remove ``--print_output=true`` in above commands


Running Tests
==============
To run the test cases

1. With Coverage Report
   Note: Make sure you have xdebug installed and enabled in PHP settings.

   Run the following command in your root folder to run test cases with coverage report
   ``sh test_with_coverage.sh``

2. Without Coverage Report

   Run the following command in your root folder to run test cases with coverage report
   ``sh test_without_coverage.sh``

PS: Previously generated coverage report is available in the file `test-coverage-report.txt` for reference

