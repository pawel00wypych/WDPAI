<?php

class SetOfExercise
{
    private int $reps;

    /**
     * RIR means "Reps in Reserve" = how many more reps could you do before failure
     * (technical failure OR actually missing a lift).
     */
    private int $rir;

    /**
     * The RPE scale is used to measure the intensity of your exercise.
     * The RPE scale runs from 0 to 10.
     * For example, 0 (nothing at all) would be how you feel when sitting in a chair; 10 (very, very heavy).
     */
    private int $rpe;
    private int $id;


    public function __construct(int $reps, int $rir, int $rpe)
    {
        $this->reps = $reps;
        $this->rir = $rir;
        $this->rpe = $rpe;
    }

    public function getReps(): int
    {
        return $this->reps;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setReps(int $reps): void
    {
        $this->reps = $reps;
    }

    public function getRir(): int
    {
        return $this->rir;
    }

    public function setRir(int $rir): void
    {
        $this->rir = $rir;
    }

    public function getRpe(): int
    {
        return $this->rpe;
    }

    public function setRpe(int $rpe): void
    {
        $this->rpe = $rpe;
    }
}