<?php
require_once __DIR__ . '/../models/UserRepository.php';

// Create instance of UserRepository
$userRepo = new UserRepository();

echo "<h1>User Repository Tests</h1>";

// Test findAll
echo "<h2>Testing findAll()</h2>";
$users = $userRepo->findAll();
echo "<p>Found " . count($users) . " users</p>";
echo "<pre>";
print_r($users);
echo "</pre>";

// Test findById
echo "<h2>Testing findById()</h2>";
if (count($users) > 0) {
    $firstUserId = $users[0]['id'];
    echo "<p>Looking for user with ID: {$firstUserId}</p>";
    $user = $userRepo->findById($firstUserId);
    echo "<pre>";
    print_r($user);
    echo "</pre>";
} else {
    echo "<p>No users found to test findById()</p>";
}

// Test create
echo "<h2>Testing create()</h2>";
$testUsername = 'testuser_' . time(); // Ensure unique username
$testEmail = 'test_' . time() . '@example.com'; // Ensure unique email
$newUserId = $userRepo->createUser($testUsername, 'password123', $testEmail);
echo "<p>Created user with ID: {$newUserId}</p>";
$newUser = $userRepo->findById($newUserId);
echo "<pre>";
print_r($newUser);
echo "</pre>";

// Test findByUsername
echo "<h2>Testing findByUsername()</h2>";
$userByUsername = $userRepo->findByUsername($testUsername);
echo "<p>Found user with username '{$testUsername}': " . ($userByUsername ? 'Yes' : 'No') . "</p>";
echo "<pre>";
print_r($userByUsername);
echo "</pre>";

// Test authenticate
echo "<h2>Testing authenticate()</h2>";
$authResult = $userRepo->authenticate($testUsername, 'password123');
echo "<p>Authentication result: " . ($authResult ? 'Success' : 'Failure') . "</p>";
$wrongAuthResult = $userRepo->authenticate($testUsername, 'wrongpassword');
echo "<p>Authentication with wrong password: " . ($wrongAuthResult ? 'Success (this is bad!)' : 'Failure (as expected)') . "</p>";

// Test update password
echo "<h2>Testing updatePassword()</h2>";
$updateResult = $userRepo->updatePassword($newUserId, 'newpassword123');
echo "<p>Update password result: " . ($updateResult ? 'Success' : 'Failure') . "</p>";
$authResultOld = $userRepo->authenticate($testUsername, 'password123');
echo "<p>Authentication with old password: " . ($authResultOld ? 'Success (this is bad!)' : 'Failure (as expected)') . "</p>";
$authResultNew = $userRepo->authenticate($testUsername, 'newpassword123');
echo "<p>Authentication with new password: " . ($authResultNew ? 'Success' : 'Failure') . "</p>";

// Test delete
echo "<h2>Testing delete()</h2>";
$deleteResult = $userRepo->delete($newUserId);
echo "<p>Delete result: " . ($deleteResult ? 'Success' : 'Failure') . "</p>";
$deletedUser = $userRepo->findById($newUserId);
echo "<p>User after deletion: " . ($deletedUser ? 'Still exists' : 'Successfully deleted') . "</p>";