<?php

namespace Dmr\PhpToJs;

class PhpToJs
{
    const NAMESPACE = 'phpToJs';

    protected string $namespace = self::NAMESPACE;

    /** @var array<string, array<string, mixed>> */
    protected array $variables = [];

    /** 
     * @param array<mixed> $items 
     */
    public function add(array $items): void
    {
        $this->variables[$this->namespace()] = array_merge(
            $this->variables[$this->namespace()] ?? [],
            $items
        );
    }

    /** 
     * @return array<string, array<string, mixed>> 
     */
    public function all(): array
    {
        return $this->variables;
    }

    /** 
     * @return array<string, mixed> 
     */
    public function variables(): array
    {
        return $this->variables[$this->namespace()] ?? [];
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function namespace(): string
    {
        return $this->namespace;
    }
}
