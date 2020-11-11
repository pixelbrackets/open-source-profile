<?php

use Pixelbrackets\OpenSourceProfile\ProfileApp;
use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;

class ProfileAppTest extends TestCase
{
    /**
     * Virtual Filesystem
     *
     * @var vfsStreamDirectory
     */
    protected $filesystem;

    /**
     * Set up test environmemt
     */
    protected function setUp(): void
    {
        $this->filesystem = vfsStream::setup('home');
        vfsStream::copyFromFileSystem(__DIR__ . '/../../data/', $this->filesystem);
        $dataStorage = vfsStream::url('home/');
        copy($dataStorage . 'projects.template.json', $dataStorage . 'projects.json');
        copy($dataStorage . 'user.template.json', $dataStorage . 'user.json');
    }

    public function testTitleIsNotEmpty()
    {
        $this->assertNotEmpty(ProfileApp::getTitle());
        $this->assertIsString(ProfileApp::getTitle());
        $this->assertStringContainsString('Open Source', ProfileApp::getTitle());
    }

    public function testUserIsNotEmpty()
    {
        $user = (new ProfileApp(vfsStream::url('home/')))->getUser();
        $this->assertIsArray($user);
        $this->assertStringContainsString('bot', $user['username']);
    }

    public function testProjectsAreNotEmpty()
    {
        $projects = (new ProfileApp(vfsStream::url('home/')))->getProjects();
        $this->assertIsArray($projects);
        $this->assertStringContainsString('github.com', $projects[0]['repository-url']);
    }
}
