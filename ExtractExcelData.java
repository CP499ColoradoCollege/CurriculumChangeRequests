import org.apache.poi.ss.usermodel.*;
//import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.io.File;
import java.io.IOException;
import java.util.Iterator;


public class ExtractExcelData {
	
	public static final String SAMPLE_XLSX_FILE_PATH = "./example.xlsx";
	public static final String PORT_NUMBER = "8889";

	public static void main (String args[]) throws IOException {
		 Workbook workbook = WorkbookFactory.create(new File(SAMPLE_XLSX_FILE_PATH));
		 System.out.println("Workbook has " + workbook.getNumberOfSheets() + " Sheets : ");
		 Sheet sheet = workbook.getSheetAt(0);

	        // Create a DataFormatter to format and get each cell's value as String
	        DataFormatter dataFormatter = new DataFormatter();
	        Iterator<Row> rowIterator = sheet.rowIterator();
	        Row row = rowIterator.next();
	        String col_name = "";
	        String row_val  = "";
	        Iterator<Cell> cellIterator = row.cellIterator();
	    
	        while (cellIterator.hasNext()) {
                Cell cell = cellIterator.next();
                String cellValue = dataFormatter.formatCellValue(cell);
                col_name += cellValue + " varchar(50), ";
                System.out.print(cellValue + "\t");
                //System.out.print(col_name);
            }
	        while (rowIterator.hasNext()) {
	        	row_val += "(";
                row = rowIterator.next();
                cellIterator = row.cellIterator();
                while (cellIterator.hasNext()) {
                	Cell content_cell = cellIterator.next();
                	String contentCellValue = dataFormatter.formatCellValue(content_cell);
                	row_val += "'" + contentCellValue + "', ";	
                }
                row_val = row_val.substring(0, row_val.length()-2) + "),";
                
           
            }
	        row_val = row_val.substring(0,row_val.length()-1);
	        System.out.println(row_val);
//		 for (Row row: sheet) {
//	            for(Cell cell: row) {
//	                String cellValue = dataFormatter.formatCellValue(cell);
//	                System.out.print(cellValue + "\t");
//	            }
//	            System.out.println();
//		 }
	            try {
	    				// Step 1: Allocate a database "Connection" object
	    				Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:" + PORT_NUMBER + "/course_proposal?user=root&password=root"); // MySQL
	    				// Step 2: Allocate a "Statement" object in the Connection
	    				Statement stmt = conn.createStatement();
	    				
	    			// Step 3 - create our database
	    			String sql = "create table if not exists course_information ( " +
	    					col_name + "primary key(t));";
	    			stmt.execute(sql);
	    			
	    		 String sqlInsert = "insert into course_information values " + row_val;
	    			stmt.executeUpdate(sqlInsert);
	        }
	            catch(SQLException ex) {
	    			ex.printStackTrace();
	    		}
	}

}
