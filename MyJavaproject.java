public import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class MyJavaproject {
	private static final String filename="C:\\Users\\Silvi\\Downloads\\seats2.txt";
	private static final double min_price= 23.5;
	//defining the attributes of the Seat class 
		class Seat{
			private String no;
			private String Seatclass; 
			private boolean IsWindow; 
			private boolean IsAisle; 
			private boolean IsTable; 
			private double price;  
			private String UserEmail; 
		
		//constructor  definition used to initialise the objects of the class Seat
		 public Seat(String no, String Seatclass,boolean IsWindow, boolean IsAisle, boolean IsTable, double price, String UserEmail) {
	     	this.no= no;
	     	this.Seatclass= Seatclass;
	     	this.IsWindow= IsWindow;
	     	this.IsAisle= IsAisle;
	     	this.IsTable= IsTable;
	     	this.price= price;
	     	this.UserEmail= UserEmail;
	     
         }
		 //getter methods to access private attributes throughout the rest of my program
		 public String GetSeatNo() {
			 return no;
		 }
		 public String GetSeatclass() {
			 return Seatclass;
		 }
		 
		 public boolean GetWindow() {
			 return IsWindow;
		 } 
		 public boolean GetAisle() {
			 return IsAisle;
		 }
		 public boolean GetTable() {
			 return IsTable;
		 }
		 public double GetPrice() {
			 return price;
		 }
		 public String GetUserEmail() {
			 return UserEmail;
		 }
		 //calling this later to output object as string
		 public String toString() {
			 return "Seat{" +
			            "no='" + no + '\'' +
			            ", Seatclass='" + Seatclass + '\'' +
			            ", IsWindow=" + IsWindow +
			            ", IsAisle=" + IsAisle +
			            ", IsTable=" + IsTable +
			            ", price=" + price +
			            ", UserEmail='" + UserEmail + '\'' +
			            '}';
			}
}
     
	 class  SeatBookingSystem {
			 private List<Seat> seats;
			 //list where all seat data will be added into
		 public  SeatBookingSystem() {
			 this.seats= new ArrayList<>();
		
}
		 

	
	//using exception to handle scenarios where file may have been deleted,lost etc..
	public void loadSeatData()throws FileNotFoundException {
		FileReader file= new FileReader(filename); 
	try	(Scanner read= new Scanner(file)){ 
		while (read.hasNext()) {
			String[] seatData= read.nextLine().split(" ");
			
			String no = seatData[0];
			String Seatclass= seatData[1];
			boolean IsWindow=Boolean.parseBoolean(seatData[2]);//converting string into boolean
			boolean IsAisle=Boolean.parseBoolean(seatData[3]);
			boolean IsTable=Boolean.parseBoolean(seatData[4]);
			double price=Double.parseDouble(seatData[5]);
			String UserEmail= seatData[6];
			
			//values added onto new instance of seat class,then onto list
			Seat seat= new Seat(no, Seatclass,IsWindow,IsAisle,IsTable,price,UserEmail);
			seats.add(seat);
			
			}read.close();
		}
}
		

	
	
	public Seat reserveSeat() {
		Scanner scanner= new Scanner(System.in); 

		String UserEmail;
		String Seatclass;
		boolean IsWindow;
		boolean IsAisle;
		boolean IsTable;
		float price;
		boolean reserved=false;
		
		//validating that user inputs correct email format
		do {
			System.out.println("Enter your email: ");
			UserEmail=scanner.nextLine();
		} while (!UserEmail.contains("@"));
		
		//validating input matches seat class format
		do {
			System.out.println("Enter Seat class preferences (1ST or STD?): ");
			Seatclass= scanner.nextLine();
		}while (!Seatclass.equals("1ST") && !Seatclass.equals("STD"));
		
		//validating boolean values
		System.out.println("Enter window preference(true/false): ");
		    IsWindow= scanner.nextBoolean();
			scanner.nextLine();// consuming the newline left in the buffer
			System.out.println("Enter aisle seat prefrence (true/false): ");
			IsAisle= scanner.nextBoolean();
			scanner.nextLine();
			System.out.println("Enter table preference (true/false): ");
			IsTable= scanner.nextBoolean();
			scanner.nextLine();
			
		//validating that the max price inputted is greater or equal than 23.50 as it is the min price on file
		do {
			System.out.println("Enter maximum price you are willing to spend: ");
			 price= scanner.nextFloat();
		}while (price <= min_price );
		
		//seat object created will be a reserved seat containing the user's specific requirements
		Seat Seatpreference= new Seat (" ",Seatclass,IsWindow,IsAisle,IsTable,price,UserEmail);
		System.out.println("Your seat preference: " +Seatpreference.toString());//string representation of object
		
        //if the user's desired seat matches any seats available, the seat will be reserved
		for (Seat seat:seats) {
			if (seat.GetWindow()==Seatpreference.GetWindow() &&
				seat.GetAisle()==Seatpreference.GetAisle() && 
				seat.GetTable()== Seatpreference.GetTable()&&
				seat.GetSeatclass().equals(Seatpreference.GetSeatclass())&&
				seat.GetPrice()<=Seatpreference.GetPrice()
				) {
		
		//seat.UserEmail= Seatpreference.GetUserEmail();
		System.out.println("Your seat has been reserved:"+seat.toString());
		reserved=true;
		break; //break out of loop after making reservation
		}
	    saveSeatData();
	}
		if (!reserved) {
		nextBestMatch(Seatpreference);
  }
		return Seatpreference;
		
}    

	
	public void cancelSeat( ) {
		for (Seat Seatpreference:seats) {
			//email check ensures that the correct seat is selecetd to be cancelled 
			if (!Seatpreference.GetUserEmail().contains("free")) {
				Seatpreference=null;
				System.out.println("Seat reservation has successfully been cancelled ");
				return; //exiting the loop
      }
   }
}
	
	
	public void ViewSeat() {
		boolean found=false; 
		
		for (Seat Seatpreference:seats) {
			//if the email on the reserved seat matches with user email
			if (!Seatpreference.GetUserEmail().contains("free")&&Seatpreference.no==Seatpreference.GetSeatNo()){
				System.out.println("Your booking: " +Seatpreference.toString());
				found=true;
				break;
			}
			}if (!found) {
				System.out.println("Sorry, no booking was found");
	   }
}
	
	public Seat nextBestMatch(Seat Seatpreference ) {
		Seat nextBestSeat= null; //currently empty as seat is yet to be found
		int count=-1;
		int noOfMatches=0;

		for (Seat seat: seats) {
			 noOfMatches= 0;//counter tracks the no of matches bewtween reserved seats and seats in list
			
			if (Seatpreference.GetSeatclass().equals(seat.GetSeatclass())) {
				noOfMatches ++; //incrementing matches will indicate what the most suitable seat is	
			}if  (Seatpreference.GetTable()==seat.GetTable()){
				noOfMatches ++; 
			}if ( Seatpreference.GetWindow()==seat.GetWindow()) {
				noOfMatches ++;
			}if  ( Seatpreference.GetAisle()==seat.GetAisle()){
				noOfMatches ++; 	
			}if  ( Seatpreference.GetPrice()>=seat.GetPrice()){
				noOfMatches ++; 
			}	
		    //ensuring new seat considered has more matches than te previously considered one and its availability
		    if (noOfMatches>count && "free".equals(seat.GetUserEmail())) {
				count=noOfMatches;
				nextBestSeat=seat;
				}	
		   }if (nextBestSeat != null ) {
				System.out.println(noOfMatches+ " of your seat requirements have been met");
				System.out.println("The next best seat is :"+ nextBestSeat);
				
		   }else{
				System.out.println ("Sorry! No suitable match available");
			     }
		   return nextBestSeat;
}
	
	
	public void saveSeatData()  {
		try (PrintWriter file= new PrintWriter(new File(filename))) {
			for (Seat Seatpreference:seats) {
				if (Seatpreference.UserEmail.equals(Seatpreference.GetUserEmail())) {
					//printf instead of string concactenation to reduce tediousness
					file.printf("%s %s %b %b %b %.2f %s%n", Seatpreference.GetSeatNo(), 
					Seatpreference.GetSeatclass(), Seatpreference.GetWindow(), Seatpreference.GetAisle(),
				    Seatpreference.GetTable(), Seatpreference.GetPrice(), Seatpreference.GetUserEmail());
				}else{
					file.printf("%s %s %b %b %b %.2f %s%n", Seatpreference.GetSeatNo(), 
					Seatpreference.GetSeatclass(), Seatpreference.GetWindow(), Seatpreference.GetAisle(),
				    Seatpreference.GetTable(), Seatpreference.GetPrice(), Seatpreference.GetUserEmail());
			    }
		    }
		} catch (IOException e) { //in case a file is not found or lost etc..
		System.out.println("An error has occured");
		e.printStackTrace();
     }
   }
}
	
	 
	private static Scanner input= new Scanner(System.in); 
		 
	public static void main(String[] args)throws Exception {
		//providing outerclass instance(MyJavaProject), in order to instantiate inner class(SeatBookingSystem)
		SeatBookingSystem seatBookingSystem1=new MyJavaproject().new SeatBookingSystem();
		try{seatBookingSystem1.loadSeatData();
	    
		String answer= "  ";
		
		
		do {
				System.out.println("\n-----MAIN MENU----");
				System.out.println("1. Reserve a seat");
				System.out.println("2.View your booking");
				System.out.println("3.Cancel your booking");
				System.out.println("4.Quit");
				System.out.println("Your choice : ");
				
				answer= input.next().toUpperCase(); 
				
				// dealing with  the different user inputs
				switch(answer) {
				case "1": { 
					seatBookingSystem1.reserveSeat();
					break;
				}
				case "2" : {
					seatBookingSystem1.ViewSeat();
					break;
				}
				case "3" : {
					seatBookingSystem1.cancelSeat();
					break;	
		        }
	         }
			
			}while(!answer.equals("4")); 
				seatBookingSystem1.saveSeatData(); //saving seat data after all operations are completed !
				System.out.println("Thank you for choosing this service,data has been saved to file!");

		}catch(FileNotFoundException e) {
				System.out.println("An error has occured");
				e.printStackTrace();
		}                    
	 }
  }




	

		  

	
		
	               
	        
  