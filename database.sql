DROP DATABASE IF EXISTS php_assign;

CREATE DATABASE IF NOT EXISTS php_assign;

USE php_assign;

DROP TABLE IF EXISTS Vehicles;
DROP TABLE IF EXISTS Owners;
DROP TABLE IF EXISTS TransportationTypes;


CREATE TABLE IF NOT EXISTS Owners(
    OwnerID INT(2) PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(20) NOT NULL,
    City VARCHAR(20) NOT NULL,
    Gender VARCHAR(20) NOT NULL,
    FamilySize INT(2) NOT NULL
)
ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS TransportationTypes(
    TransID INT(2) PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(20) NOT NULL,
    Description VARCHAR(100) NOT NULL,
    Wheels INT(2) NOT NULL,
    FuelType VARCHAR(20) NOT NULL
)
ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Vehicles(
    VehicleID INT(2) PRIMARY KEY AUTO_INCREMENT,
    MakeModel VARCHAR(30) NOT NULL,
    Color VARCHAR(20) NOT NULL,
    OwnerID INT(2) NOT NULL,
    TypeID INT(2) NOT NULL,
    FOREIGN KEY(OwnerID) REFERENCES owners(OwnerID),
    FOREIGN KEY(TypeID) REFERENCES transportationtypes(TransID)
)

ENGINE=InnoDB;

INSERT INTO OWNERS(Name, City, Gender, FamilySize)
            VALUES ("Angelo", "Coquitlam", "Male", 6);

INSERT INTO OWNERS(Name, City, Gender, FamilySize)
            VALUES ("Emelie", "Surrey", "Female", 5);

INSERT INTO OWNERS(Name, City, Gender, FamilySize)
            VALUES ("Colton", "Coquitlam", "Male", 1);

INSERT INTO OWNERS(Name, City, Gender, FamilySize)
            VALUES ("Boris", "Richmond", "Male", 2);

INSERT INTO OWNERS(Name, City, Gender, FamilySize)
            VALUES ("Celene", "Vancouver", "Female", 3);

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Truck", "A large, heavy motor vehicle used for transporting goods, materials, or troops.", 6, "Diesel");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Bike", "A two motor vehicle.", 2, "Ethanol");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Jet Plane", "An aircraft propelled by jet engines .", 3, "Jet Fuel");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("4-Door Sedan", "A vehicle with four doors used for passengers in mind.", 4, "Ethanol");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Sports Car", "A vehicle with a powerfull engine designed for speed and power.", 4, "Ethanol");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Boat", "A watercraft propelled by a rear engine.", 0, "Diesel");

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("2019 RAM 1500", "Red", 2, 1);

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("F22 Fighter", "Gold", 1, 3);

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("1966 Ford Mustang", "Blue", 3, 5);

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("2008 Volkswagon Golf", "Black", 4, 4);

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("Fishing Model 1460P", "Silver", 5, 6);
