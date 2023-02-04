<?php

class Exercise
{
    private string $exerciseName;
    private int $weight;
    private string $description;
    private int $totalHSR;
    private int $totalReps;
    private int $totalVolume;

    public function __construct(string $exerciseName, int $weight, string $description, int $totalHSR, int $totalReps, int $totalVolume)
    {
        $this->exerciseName = $exerciseName;
        $this->weight = $weight;
        $this->description = $description;
        $this->totalHSR = $totalHSR;
        $this->totalReps = $totalReps;
        $this->totalVolume = $totalVolume;
    }

    public function getExerciseName(): string
    {
        return $this->exerciseName;
    }

    public function setExerciseName(string $exerciseName): void
    {
        $this->exerciseName = $exerciseName;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTotalHSR(): int
    {
        return $this->totalHSR;
    }

    public function setTotalHSR(int $totalHSR): void
    {
        $this->totalHSR = $totalHSR;
    }

    public function getTotalReps(): int
    {
        return $this->totalReps;
    }

    public function setTotalReps(int $totalReps): void
    {
        $this->totalReps = $totalReps;
    }

    public function getTotalVolume(): int
    {
        return $this->totalVolume;
    }

    public function setTotalVolume(int $totalVolume): void
    {
        $this->totalVolume = $totalVolume;
    }



}