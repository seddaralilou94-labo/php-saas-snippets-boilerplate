<?php
/**
 * 10 — Lightweight Input Validator
 * ------------------------------------------------
 * Purpose: validate form/API input with a simple fluent-ish API,
 * without pulling in a full framework's validation package.
 *
 * Usage:
 *   $v = new Validator($_POST);
 *   $v->required('email')->email('email');
 *   $v->required('salary')->numeric('salary')->min('salary', 0);
 *
 *   if ($v->fails()) {
 *       http_response_code(422);
 *       echo json_encode(['errors' => $v->errors()]);
 *       exit;
 *   }
 */

class Validator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function required(string $field): self
    {
        if (!isset($this->data[$field]) || trim((string) $this->data[$field]) === '') {
            $this->errors[$field][] = "Le champ $field est requis.";
        }
        return $this;
    }

    public function email(string $field): self
    {
        if (isset($this->data[$field]) && !filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Le champ $field doit être une adresse email valide.";
        }
        return $this;
    }

    public function numeric(string $field): self
    {
        if (isset($this->data[$field]) && !is_numeric($this->data[$field])) {
            $this->errors[$field][] = "Le champ $field doit être numérique.";
        }
        return $this;
    }

    public function min(string $field, float $min): self
    {
        if (isset($this->data[$field]) && is_numeric($this->data[$field]) && $this->data[$field] < $min) {
            $this->errors[$field][] = "Le champ $field doit être supérieur ou égal à $min.";
        }
        return $this;
    }

    public function max(string $field, float $max): self
    {
        if (isset($this->data[$field]) && is_numeric($this->data[$field]) && $this->data[$field] > $max) {
            $this->errors[$field][] = "Le champ $field doit être inférieur ou égal à $max.";
        }
        return $this;
    }

    public function maxLength(string $field, int $length): self
    {
        if (isset($this->data[$field]) && mb_strlen((string) $this->data[$field]) > $length) {
            $this->errors[$field][] = "Le champ $field ne doit pas dépasser $length caractères.";
        }
        return $this;
    }

    public function in(string $field, array $allowed): self
    {
        if (isset($this->data[$field]) && !in_array($this->data[$field], $allowed, true)) {
            $this->errors[$field][] = "Valeur invalide pour $field.";
        }
        return $this;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
