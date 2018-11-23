<?php

declare(strict_types=1);

namespace App\Command;

use App\SomeNode;
use SplFileObject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class XmlCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'app:xml';

    /** @var SerializerInterface */
    private $serializer;

    /** @var string */
    private $importDir;

    public function __construct(SerializerInterface $serializer, string $importDir)
    {
        $this->serializer = $serializer;
        $this->importDir  = $importDir;

        parent::__construct(static::getDefaultName());
    }

    protected function configure()
    {
        $this->setDescription('Test XmlEncoder in Combination with ArrayAdapter / CacheItem Cache');
        $this->addArgument('filename', InputArgument::REQUIRED, "path relative to {$this->importDir}");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');

        $file = new SplFileObject("{$this->importDir}/{$filename}");

        $test = $this->serializer->deserialize($file->fread($file->getSize()), SomeNode::class, $file->getExtension());

        var_dump($test->getSomesubnode());
    }
}
