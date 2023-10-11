<?php
use PHPUnit\Framework\TestCase;

class ModifyUserContractModelTest extends TestCase
{
    public function testModifyUserContract()
    {
        // Set up the test data
        $_POST['userContract'] = 'Full-time';
        $data['id'] = 1;

        // Include the file to be tested
        require('./modifyUserContractModel.php');

        // Check that the user's contract type was updated in the database
        $r = $bdd->prepare("SELECT contract_type FROM `user` WHERE id = ?");
        $r->execute([$data['id']]);
        $contractType = $r->fetchColumn();
        $this->assertEquals('Full-time', $contractType);
    }
}
?>