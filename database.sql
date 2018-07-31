DROP DATABASE IF EXISTS php_assign;

CREATE DATABASE IF NOT EXISTS php_assign;

USE php_assign;

CREATE TABLE owners(
    OwnerID INT(2) PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(20) NOT NULL,
    City VARCHAR(20) NOT NULL,
    Gender VARCHAR(20) NOT NULL,
    FamilySize INT(2) NOT NULL
)
ENGINE=InnoDB;

CREATE TABLE TransportationTypes(
    TransID INT(2) PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(20) NOT NULL,
    Description VARCHAR(100) NOT NULL,
    Wheels INT(2) NOT NULL,
    FuelType VARCHAR(20) NOT NULL
)
ENGINE=InnoDB;

CREATE TABLE Vehicles(
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

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Truck", "A large, heavy motor vehicle used for transporting goods, materials, or troops.", 6, "Diesel");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Bike", "A two motor vehicle.", 2, "Ethanol");

INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
VALUES ("Jet Plane", "An aircraft propelled by jet engines .", 3, "Jet Fuel");

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("2019 RAM 1500", "Red", 2, 1);

INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
VALUES ("F22 Fighter", "Gold", 1, 3);
