# Seat-Booking-System
Code for a console application in Java

A new seat booking system is required to help users reserve a seat based on the following requirements:
• First or Standard Class.
• By Window or Aisle.
• With or Without Table.
• Seat Price (The maximum price the user could afford).
When a suitable match is found, the user (identified by their eMail) should be able to reserve the seat. Seat
reservations may also be cancelled. The seat data should be modelled in a file seats.txt that will contain the seat
data and any reservations, though initially every seat should be unreserved. Upon application launches, the data
should be loaded into appropriate data structures and upon application exits, the data should be saved back to the
file.


he format of each seat’s data is as follows:
seatNum seatClass isWindow isAisle isTable seatPrice eMail

You are then required to produce a console application (using Java) that is driven by a repeating main menu (i.e.
Appendix B) with appropriate instructions and guidance throughout. Menu options should include reserving a seat,
cancelling a seat, and viewing seat reservations.
To maximise your credit, you should also try to implement the following functionalities:
• Performing input validation (i.e. fallacious input should be rejected).
• Before rejecting a reservation (i.e. no seats match the user’s seat
requirements) the application offers the “next best match”
(i.e. we can match 3 of your 4 seat requirements)
