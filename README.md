#FROST PHP

## Introduction

> Framework for building PHP sites with login

## Code Samples

        $frost = new frost_auth($_SESSION['dbLink'], 'usersColumnsInDB');
        $frost->username = ['', 'usernamesColumnInDB'];
        $frost->email = [$_POST['emailNameFromForm'], 'emailsColumnInDB'];
        $frost->password = [$_POST['passwordNameFromForm'], 'passwordsColumnInDB'];
        $frost->login();

## Installation

> Put 'frost.php' to your project directory. 
