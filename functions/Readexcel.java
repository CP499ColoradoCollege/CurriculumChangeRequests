import java.io.IOException;
import java.net.MalformedURLException;
import java.util.*;
import java.io.File;
import java.util.Scanner;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.lang.Object;
import java.io.IOException;
import java.util.Date;
import java.lang.NullPointerException;

import jxl.*;
import jxl.read.biff.BiffException;
import jxl.write.*;
import jxl.write.Boolean;
import jxl.write.Number;
import jxl.write.biff.RowsExceededException;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;


public class Readexcel{

	static String EXCEL_FILE_LOCATION = "C:\\Users\\Christian\\Downloads\\coursedata.xls";
	static Workbook workbook = null;
	
	private static final String PORT_NUMBER = "3306";
	private static String database_name = "proposals";


	public static void main(String[] args) throws IOException, RowsExceededException, WriteException, BiffException {

		//first, i want to read in the data of an existing Excel sheet
		workbook = Workbook.getWorkbook(new File("C:\\Users\\Christian\\Downloads\\coursedata.xls"));
		Sheet sheet1 = workbook.getSheet(0);

		int y = 0;
		long counter = 0;

		while(y < 5) {

      Cell subj_code_cell = sheet1.getCell(0, y);
      Cell subj_desc_cell = sheet1.getCell(1, y);
      Cell course_num_cell = sheet1.getCell(2, y);
      Cell divs_code_cell = sheet1.getCell(3, y);
      Cell divs_desc_cell = sheet1.getCell(4, y);
      Cell dept_code_cell = sheet1.getCell(5, y);
      Cell dept_desc_cell = sheet1.getCell(6, y);
      Cell course_title_cell = sheet1.getCell(7, y);
      Cell course_desc_cell = sheet1.getCell(8, y);
      Cell extra_desc_cell = sheet1.getCell(9, y);
      Cell prereqs_cell = sheet1.getCell(10, y);
      Cell units_cell = sheet1.getCell(15, y);

      String subj_code = "'" + subj_code_cell.getContents() + "'";
      String subj_desc =  "'" + subj_desc_cell.getContents() + "'";
      String course_num =  "'" + course_num_cell.getContents() + "'";
      String divs_code =  "'" + divs_code_cell.getContents() + "'";
      String divs_desc =  "'" + divs_desc_cell.getContents() + "'";
      String dept_code =  "'" + dept_code_cell.getContents() + "'";
      String dept_desc =  "'" + dept_desc_cell.getContents() + "'";
      String course_title =  "'" + course_title_cell.getContents() + "'";
      String course_desc =  "'" + course_desc_cell.getContents() + "'";
      String extra_desc =  "'" + extra_desc_cell.getContents() + "'";
      String prereqs =  "'" + prereqs_cell.getContents() + "'";
      String units =  "'" + units_cell.getContents() + "'";

      try(
  		//step 2: Add tables to the database

  			// Allocate a database "Connection" object
  			Connection conn = DriverManager.getConnection(
  					"jdbc:mysql://localhost:" + PORT_NUMBER + "/" + database_name + "?user=root&password=root"); // MySQL
  			// Allocate a "Statement" object in the Connection
  			Statement stmt = conn.createStatement();
  			) {
  			// create our new tables


  			//add 3 students to the Student table
  			String sqlInsert = "insert into courses (subj_code, subj_desc, course_num, divs_code, dept_code, dept_desc, course_title, course_desc, extra_desc, prereqs, units) values " +
        "(" + subj_code + ", " + subj_desc + ", " + course_num + ", " + divs_code + ", " + divs_desc + ", " + dept_code + ", " + dept_desc
        + ", " + course_title + ", " + course_desc + ", " + extra_desc + ", " + prereqs + ", " + units + ")";

  			System.out.println("The SQL query is: " + sqlInsert);  // Echo for debugging
  			int countInserted = stmt.executeUpdate(sqlInsert);

      } catch(SQLException ex) {
  			ex.printStackTrace();
  		}

			y++;
		}//end of while loop
	}//end of main

}
