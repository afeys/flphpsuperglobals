<?php

namespace FL;

final class Request
{
    public function __construct(
        private array $get,
        private array $post,
        private array $server,
        private array $overrides = [],
    )   {}

    public static function fromGlobals(): self
    {
        return new self($_GET, $_POST, $_SERVER);
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

// --- reading (merged): overrides win, then POST, then GET ---

    private function raw(string $key): mixed
    {
        return $this->overrides[$key] ?? $this->post[$key] ?? $this->get[$key] ?? null;
    }

    public function getString(string $key, ?string $default = null): ?string
    {
        $v = $this->raw($key);
        return $v === null ? $default : trim((string)$v);
    }

    public function getInt(string $key, ?int $default = null): ?int
    {
        $v = $this->raw($key);
        return ($v === null || $v === '') ? $default : (int)$v;
    }

    public function getBool(string $key, bool $default = false): bool
    {
        $v = $this->raw($key);
        return $v === null
            ? $default
            : (filter_var($v, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $default);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->overrides)
            || array_key_exists($key, $this->post)
            || array_key_exists($key, $this->get);
    }

// --- reading (source-explicit): deliberately ignore overrides ---

    public function query(string $key, mixed $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }

    public function body(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    public function hasQuery(string $key): bool
    {
        return array_key_exists($key, $this->get);
    }

    public function hasBody(string $key): bool
    {
        return array_key_exists($key, $this->post);
    }

// --- writing: goes to overrides, never touches original input ---

    public function set(string $key, mixed $value): self
    {
        $this->overrides[$key] = $value;
        return $this;
    }

    public function setMany(array $values): self
    {
        foreach ($values as $key => $value) {
            $this->overrides[$key] = $value;
        }
        return $this;
    }

    public function unset(string $key): self
    {
        unset($this->overrides[$key]);
        return $this;
    }

// --- handoff to JavaScript ---

    public function forJs(array $keys): array
    {
        $out = [];
        foreach ($keys as $key) {
            $out[$key] = $this->raw($key);   // merged view, so set() values are included
        }
        return $out;
    }
}