<?php
namespace Pixelbrackets\OpenSourceProfile;

class ProfileApp
{
    /**
     * Title of the app
     *
     * @var string
     */
    protected static $title = 'Open Source Profile';

    /**
     * Data Storage Directory
     *
     * @var string
     */
    protected $dataStorage = __DIR__ . '/../data/';

    /**
     * User metadata (Name, Username etc)
     *
     * @var array<string>
     */
    protected $user = [];

    /**
     * List of projects
     *
     * @var array<string>
     */
    protected $projects = [];

    /**
     * Initiate the project list of the user
     *
     * @param string $dataStorage
     */
    public function __construct($dataStorage = '')
    {
        if (empty($dataStorage) === false) {
            $this->dataStorage = $dataStorage;
        }

        $user = file_get_contents($this->dataStorage . 'user.json');
        if ($user !== false) {
            $this->user = json_decode($user, true);
        }
        $projects = file_get_contents($this->dataStorage . 'projects.json');
        if ($projects !== false) {
            $this->projects = json_decode($projects, true);
        }
    }

    /**
     * Returns the title of the app
     *
     * @return string
     */
    public static function getTitle(): string
    {
        return self::$title;
    }

    /**
     * Returns the user metadata
     *
     * @return array<string>
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * Returns the project list
     *
     * @return array<string>
     */
    public function getProjects(): array
    {
        return $this->projects;
    }
}
