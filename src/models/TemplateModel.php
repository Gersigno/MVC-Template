<?php
class TemplateModel {

    public function __construct(
        protected string    $name,
        protected string    $birth_date,
        protected bool      $is_male
    ) {}

    public function getName(): string {
        return $this->name;
    }
    public function getBirthDate(): string {
        return date('Y-m-d', strtotime($this->birth_date));
    }
    public function getIsMale(): bool {
        return $this->is_male;
    }

    /**
     * Calculates the user's current age based on the birth date.
     *
     * @return int The age in full years.
     */
    public function getAge(): int {
        $birth_date = new DateTime($this->birth_date);
        $today = new DateTime();
        $age = $today->diff($birth_date)->y;
        return $age;
    }
}