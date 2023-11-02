<?php
/**
 * VAXKID Configuration File
 */
 
 error_reporting(E_ALL);

date_default_timezone_set("Asia/Manila");

// DATABASE CONFIGURATION
//   const DB_HOST = "localhost";
//   const DB_NAME = "vaxkid";
//   const DB_USER = "root";
// const DB_PASS = "";

const DB_HOST = "localhost";
const DB_NAME = "rhutagud_vaxkid";
const DB_USER = "rhutagud_root";
const DB_PASS = "F2Al_rhkZ2QR";

// SITE CONFIGURATION
const SMS_SENDER = "gsm"; // gsm = send with gsm api; api = send with fortres api; 0 = Disabled
const APP_NAME = "VaxKid";
const APP_DOMAIN = "http://localhost:8000"; // Testing
//define("APP_DOMAIN", "https://www.rhutagudin.info"); // Production

const SEND_BEFORE_DAYS = 1; // Send SMS before given day/s (DEFAULT: 1 day before)

//API SEND SMS
const CLIENT_ID = "80380daf-98f1-4909-8daf-e03dae8d7936";
const CLIENT_SECRET = "36XypF3IbreWMJMH2Gt1VOWGJA2NW6o9IDV20mHH";

// GSM MODEM API
//define("GSM_API", "https://sendsms.peri.gq"); // Production
const GSM_API = "http://192.168.100.101:8080"; // Testing
const GSM_USERNAME = "test";
const GSM_PASSWORD = "test";