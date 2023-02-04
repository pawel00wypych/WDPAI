<?php

class Workout
{
    private string $description;
    private string $workoutName;

    private int $totalTime;

    /**
     * HSR - Highly Stimulating Reps
     */
    private int $totalHSR;

    /**
     * Volume = Sets * Reps * Weight
     * Old Training approach, HSR recommended
     */
    private int $totalVolume;

    private int $totalReps;

    public function __construct(string $description, string $workoutName, int $totalTime, int $totalHSR, int $totalVolume, int $totalReps)
    {
        $this->description = $description;
        $this->workoutName = $workoutName;
        $this->totalTime = $totalTime;
        $this->totalHSR = $totalHSR;
        $this->totalVolume = $totalVolume;
        $this->totalReps = $totalReps;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getWorkoutName(): string
    {
        return $this->workoutName;
    }

    public function setWorkoutName(string $workoutName): void
    {
        $this->workoutName = $workoutName;
    }

    public function getTotalTime(): int
    {
        return $this->totalTime;
    }

    public function setTotalTime(int $totalTime): void
    {
        $this->totalTime = $totalTime;
    }

    public function getTotalHSR(): int
    {
        return $this->totalHSR;
    }

    public function setTotalHSR(int $totalHSR): void
    {
        $this->totalHSR = $totalHSR;
    }

    public function getTotalVolume(): int
    {
        return $this->totalVolume;
    }

    public function setTotalVolume(int $totalVolume): void
    {
        $this->totalVolume = $totalVolume;
    }

    public function getTotalReps(): int
    {
        return $this->totalReps;
    }

    public function setTotalReps(int $totalReps): void
    {
        $this->totalReps = $totalReps;
    }
}