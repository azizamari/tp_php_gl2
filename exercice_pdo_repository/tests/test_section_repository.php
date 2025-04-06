<?php
require_once __DIR__ . '/../models/SectionRepository.php';

// Create instance of SectionRepository
$sectionRepo = new SectionRepository();

echo "<h1>Section Repository Tests</h1>";

// Test findAll
echo "<h2>Testing findAll()</h2>";
$sections = $sectionRepo->findAll();
echo "<p>Found " . count($sections) . " sections</p>";
echo "<pre>";
print_r($sections);
echo "</pre>";

// Test findById
echo "<h2>Testing findById()</h2>";
if (count($sections) > 0) {
    $firstSectionId = $sections[0]['id'];
    echo "<p>Looking for section with ID: {$firstSectionId}</p>";
    $section = $sectionRepo->findById($firstSectionId);
    echo "<pre>";
    print_r($section);
    echo "</pre>";
} else {
    echo "<p>No sections found to test findById()</p>";
}

// Test create
echo "<h2>Testing create()</h2>";
$newSectionId = $sectionRepo->createSection('Test Section', 'This is a test section created by the repository');
echo "<p>Created section with ID: {$newSectionId}</p>";
$newSection = $sectionRepo->findById($newSectionId);
echo "<pre>";
print_r($newSection);
echo "</pre>";

// Test update
echo "<h2>Testing update()</h2>";
$updateResult = $sectionRepo->updateSection($newSectionId, 'Updated Test Section', 'This section was updated');
echo "<p>Update result: " . ($updateResult ? 'Success' : 'Failure') . "</p>";
$updatedSection = $sectionRepo->findById($newSectionId);
echo "<pre>";
print_r($updatedSection);
echo "</pre>";

// Test findBy
echo "<h2>Testing findBy()</h2>";
$sectionsByDesignation = $sectionRepo->findByDesignation('Test');
echo "<p>Found " . count($sectionsByDesignation) . " sections with 'Test' in designation</p>";
echo "<pre>";
print_r($sectionsByDesignation);
echo "</pre>";

// Test delete
echo "<h2>Testing delete()</h2>";
$deleteResult = $sectionRepo->delete($newSectionId);
echo "<p>Delete result: " . ($deleteResult ? 'Success' : 'Failure') . "</p>";
$deletedSection = $sectionRepo->findById($newSectionId);
echo "<p>Section after deletion: " . ($deletedSection ? 'Still exists' : 'Successfully deleted') . "</p>";