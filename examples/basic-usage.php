<?php

/**
 * Basic Usage Example for ZKTeco Laravel Package
 * 
 * This example shows how to use the ZKTeco package in a Laravel application.
 */

// Method 1: Using Facade (Recommended)
use maliklibs\Zkteco\Facades\ZKTeco;

try {
    // Connect to device
    if (ZKTeco::connect()) {
        echo "Connected to device successfully!\n";
        
        // Get device information
        $version = ZKTeco::version();
        echo "Device Version: " . $version . "\n";
        
        $serialNumber = ZKTeco::serialNumber();
        echo "Serial Number: " . $serialNumber . "\n";
        
        // Get all users
        $users = ZKTeco::getUser();
        echo "Total Users: " . count($users) . "\n";
        
        // Get attendance data
        $attendance = ZKTeco::getAttendance();
        echo "Total Attendance Records: " . count($attendance) . "\n";
        
        // Write to LCD display
        ZKTeco::writeLCD(1, 'Hello World');
        
        // Disconnect
        ZKTeco::disconnect();
        echo "Disconnected from device.\n";
    } else {
        echo "Failed to connect to device.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Method 2: Using Dependency Injection (in a Controller)
/*
class AttendanceController extends Controller
{
    public function index(\maliklibs\Zkteco\Lib\ZKTeco $zk)
    {
        try {
            $zk->connect();
            
            $attendance = $zk->getAttendance();
            $users = $zk->getUser();
            
            $zk->disconnect();
            
            return response()->json([
                'attendance' => $attendance,
                'users' => $users
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
*/

// Method 3: Manual Instantiation
/*
use maliklibs\Zkteco\Lib\ZKTeco;

$zk = new ZKTeco('192.168.1.201', 4370, 5);

if ($zk->connect()) {
    // Your code here
    $zk->disconnect();
}
*/ 