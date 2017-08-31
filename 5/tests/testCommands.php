<?php
spl_autoload_register('__autoload');

class testSample extends PHPUnit_Framework_TestCase
{
    protected function getCommandOutput($cmd)
    {
        $output = '';
        exec('php ./shop.php', $output);
        return $output;
    }

    public function test_commandList()
    {
        $output = $this->getCommandOutput('php ./shop.php');
        $this->assertTrue(strstr($output[0], 'Available commands') >= 0);
    }


    public function test_commandsAreReal()
    {

        $output = $this->getCommandOutput('php ./shop.php');
        $this->assertEquals(2, count($output)-1);
        $commandsFromOutput = [];
        for ($i = 1; $i < count($output); $i++) {
            $commandsFromOutput[explode(':', $output[$i])[0]] = true;
        }

        $dir = opendir(Config::get('path_commands'));
        $commandsToTest = count($commandsFromOutput);
        while ($rd = readdir($dir)) {
            if ($rd !== '..' && $rd !== '.' && $rd !== 'ICommand.class.php' && $rd !== 'Command.class.php') {
                $command = str_replace('.class.php', '', $rd);
                if (isset($commandsFromOutput[$command])) {
                    $commandsToTest--;
                }
            }
        }
        closedir($dir);
        $this->assertEquals(0, $commandsToTest);
    }

    public function test_CommandFixtures()
    {
        App::Init();
        db::getInstance()->Query('INSERT INTO pages (name) VALUES ("testname")');
        $c1 = $this->getPagesCount();
        system('php shop.php fixture');
        $c2 = $this->getPagesCount();
        $this->assertTrue($c1 > $c2);
    }

    public function test_WrongCommand()
    {
        $returnCode = 0;
        $output = '';
        exec('php shop.php fixture', $output, $returnCode);
        $this->assertEquals(0, $returnCode);
        exec('php shop.php geekbrains', $output, $returnCode);
        $this->assertNotEquals(0, $returnCode);
    }

    protected function getPagesCount()
    {
        return db::getInstance()->select('SELECT COUNT(*) as c FROM pages')[0]['c'];
    }


}