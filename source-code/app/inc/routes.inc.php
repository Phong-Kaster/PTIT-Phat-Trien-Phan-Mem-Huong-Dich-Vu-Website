<?php 
// Language slug
// 
// Will be used theme routes
$langs = [];
foreach (Config::get("applangs") as $l) {
    if (!in_array($l["code"], $langs)) {
        $langs[] = $l["code"];
    }

    if (!in_array($l["shortcode"], $langs)) {
        $langs[] = $l["shortcode"];
    }
}
$langslug = $langs ? "[".implode("|", $langs).":lang]" : "";


/**
 * Theme Routes
 */

// Index (Landing Page)
// 
// Replace "Index" with "Login" to completely disable Landing page 
// After this change, Login page will be your default landing page
// 
// This is useful in case of self use, or having different 
// landing page in different address. For ex: you can install the script
// to subdirectory or subdomain of your wordpress website.
App::addRoute("GET|POST", "/", "Index");
App::addRoute("GET|POST", "/".$langslug."?/?", "Index");

// Login
App::addRoute("GET|POST", "/".$langslug."?/login/?", "Login");

// Signup
// 
//  Remove or comment following line to completely 
//  disable signup page. This might be useful in case 
//  of self use of the script
App::addRoute("GET|POST", "/".$langslug."?/signup/?", "Signup");

// Logout
App::addRoute("GET", "/".$langslug."?/logout/?", "Logout");

// Recovery
App::addRoute("GET", "/".$langslug."?/recovery/?", "Recovery");
App::addRoute("GET|POST", "/".$langslug."?/recovery/[i:id].[a:hash]/?", "PasswordReset");



/**
 * App Routes
 */

// Users
App::addRoute("GET|POST", "/users/?", "Users");
// New User
App::addRoute("GET|POST", "/users/new/?", "User");
// Profile
App::addRoute("GET|POST", "/profile/?", "Profile");


// Email verification
App::addRoute("GET|POST", "/verification/email/[i:id].[a:hash]?/?", "EmailVerification");


/***************************************************/
/***********************PHONG************************/
/***************************************************/
// New Income|Expense Transaction
App::addRoute("GET", "/transaction/?", "Transaction");

// Income
App::addRoute("GET", "/income/?", "Income");
// New Income
App::addRoute("GET", "/income/new/?", "Transaction");

// Expense
App::addRoute("GET", "/expense/?", "Expense");

// Accounts
App::addRoute("GET", "/accounts/?", "Accounts");
App::addRoute("GET", "/accounts/detail/[i:id]?", "Account");

// Budgets
App::addRoute("GET", "/budgets/?", "Budgets");
//Goals
App::addRoute("GET", "/goals/?", "Goals");

// Calendar
App::addRoute("GET", "/calendar/?", "Calendar");

//Goals
App::addRoute("GET", "/goals/?", "Goals");

//Report
App::addRoute("GET", "/reports/allreports/?", "Reports");


//Category Income
App::addRoute("GET", "/incomecategory/?", "IncomeCategory");
//Category Expense
App::addRoute("GET", "/expensecategory/?", "ExpenseCategory");

// Setting - Profile setting
App::addRoute("GET|POST", "/settings/profile/?", "Profile");
// Setting - Application setting
App::addRoute("GET", "/settings/application/?", "Application");
// Setting - SMTP setting
App::addRoute("GET", "/settings/smtp/?", "Smtp");


$report_pages = [
    "income", "expense",
    "incomevsexpense", "incomemonth",
    "expensemonth", "transactions"
];
App::addRoute("GET", "/report/[".implode("|",$report_pages).":page]/?", "Report");

/***************************************************/
/***********************END PHONG************************/
/***************************************************/