package main

import (
	"fmt"
	"os"
	"bufio"
	"math/rand"
	"time"
	"strconv"
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
	"context"
)

type Employee struct {
	firstname, lastname, email, phonenumber string
}

type Hardware struct {
	device, name, serialnumber string
	userid int64
}

const (
	username = "remote"
	password = "P@ssw0rd1"
	hostname = "172.16.13.5"
	database = "challenge"
)

var employees []Employee
var hardware []Hardware

func main() {
	count, err := strconv.Atoi(os.Args[1])
	errorcheck(err)
	generate(count)
	employeeIDs := insertEmployees()
	generateHardware(employeeIDs)
	insertHardware()
}

func insertEmployees() []int64 {
	db, err := sql.Open("mysql", dsn())
	errorcheck(err)
	defer db.Close()

	ctx, cancelfunc := context.WithTimeout(context.Background(), 5*time.Second)
	defer cancelfunc()
	stmt, err := db.PrepareContext(ctx, "INSERT INTO employees (firstname, lastname, email, telefoon, active) VALUES (?, ?, ?, ?, ?)",)
	errorcheck(err)

	var employeeIDs []int64

	for _, employee := range employees {
		result, err := stmt.Exec(employee.firstname, employee.lastname, employee.email, employee.phonenumber, true)
		errorcheck(err)
		employeeID, _ := result.LastInsertId()
		employeeIDs = append(employeeIDs, employeeID)
	}

	return employeeIDs
}

func generateHardware(employeeIDs []int64) {
	laptops := read("laptops")
	phones := read("phones")
	tablets := read("tablets")

	for _, employeeID := range employeeIDs {

		laptop := laptops[rand.Intn(len(laptops))]
		hardware = append(hardware, Hardware{"laptop", laptop, generateSerialNumber(), employeeID})
		phone := phones[rand.Intn(len(phones))]
		hardware = append(hardware, Hardware{"phone", phone, generateSerialNumber(), employeeID})
		tablet := tablets[rand.Intn(len(tablets))]
		hardware = append(hardware, Hardware{"tablet", tablet, generateSerialNumber(), employeeID})
	}
}

func insertHardware() {
	db, err := sql.Open("mysql", dsn())
	errorcheck(err)
	defer db.Close()

	ctx, cancelfunc := context.WithTimeout(context.Background(), 5*time.Second)
	defer cancelfunc()
	stmt, err := db.PrepareContext(ctx, "INSERT INTO hardware (device, name, serialnumber, userid) VALUES (?, ?, ?, ?)",)
	errorcheck(err)

	for _, hardwarepiece := range hardware {
		_, err := stmt.Exec(hardwarepiece.device, hardwarepiece.name, hardwarepiece.serialnumber, hardwarepiece.userid)
		errorcheck(err)
	}
}

func generateSerialNumber() string {
	var serialNumber string
	for j := 0; j < 20; j++ {
		serialNumber = serialNumber + strconv.Itoa(rand.Intn(10))
	}
	return serialNumber
}

func generate(count int) {
	firstnames := read("firstnames")
	lastnames := read("lastnames")
	email := read("email")

	rand.Seed(time.Now().UnixNano())
	for i := 0; i < count; i++ {
		firstname := firstnames[rand.Intn(len(firstnames))]
		lastname := lastnames[rand.Intn(len(lastnames))]
		emailaddress := firstname + lastname + "@" + email[rand.Intn(len(email))]

		phonenumber := "06"

		for j := 0; j < 8; j++ {
			phonenumber = phonenumber + strconv.Itoa(rand.Intn(10))
		}

		employee := Employee{firstname, lastname, emailaddress, phonenumber}

		employees = append(employees, employee)
	}
}

func read(filename string) []string {
	file, err := os.Open("data/" + filename)
	errorcheck(err)
	defer file.Close()

	var lines []string

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		lines = append(lines, scanner.Text())
	}

	if err := scanner.Err(); err != nil {
		panic(err)
	}

	return lines
}

func dsn() string {
	return fmt.Sprintf("%s:%s@tcp(%s)/%s", username, password, hostname, database)
}

func errorcheck(err error) {
	if err != nil {
		panic(err)
	}
}
