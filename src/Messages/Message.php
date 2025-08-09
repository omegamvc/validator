<?php

declare(strict_types=1);

namespace Validator\Messages;

use ArrayAccess;
use Validator\Contract\ValidationPropertyInterface;

/**
 * @implements ArrayAccess<string,string>
 */
final class Message implements \ArrayAccess, ValidationPropertyInterface
{
    /** @var array<string, string> */
    private $messages = [];

    /**
     * Set message value using __set.
     *
     * @return void
     */
    public function __set(string $rule, string $message)
    {
        $this->set($rule, $message);
    }

    /**
     * Add error message directive to poolcolection.
     */
    public function set(string $rule, string $message): self
    {
        $this->messages[$rule] = $message;

        return $this;
    }

    /**
     * Add error message directive to poolcolection.
     *
     * @param array<string, string> $errorMessages
     */
    public function add(array $errorMessages): self
    {
        foreach ($errorMessages as $rule => $message) {
            $this->set($rule, $message);
        }

        return $this;
    }

    /**
     * Get messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return $this->messages;
    }

    // array access intereface

    /**
     * Assigns a value to the specified offset.
     *
     * @param string $offset the offset to assign the value to
     * @param string $value  the value to set
     */
    public function offsetSet($offset, $value): void
    {
        $this->messages[$offset] = $value;
    }

    /**
     * Whether or not an offset exists.
     * This method is executed when using isset() or empty().
     *
     * @param string $offset an offset to check for
     *
     * @return bool returns true on success or false on failure
     */
    public function offsetExists($offset): bool
    {
        return isset($this->messages[$offset]);
    }

    /**
     * Unsets an offset.
     *
     * @param string $offset unsets an offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->messages[$offset]);
    }

    /**
     * Returns the value at specified offset.
     *
     * @param string $offset the offset to retrieve
     *
     * @return string|null Can return all value types
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->messages[$offset]) ? $this->messages[$offset] : null;
    }
}
