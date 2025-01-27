<?php
class CreateCommentDTO
{
    private int $alojamiento_id;
    private string $comment;
    private float $score;
    private string $user_id;

    //getters and setters
    public function getAlojamiento_id(): int
    {
        return $this->alojamiento_id;
    }


    public function setAlojamiento_id(int $alojamiento_id): void
    {
        $this->alojamiento_id = $alojamiento_id;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function setScore(float $score): void
    {
        $this->score = $score;
    }

    public function getUser_id(): string
    {
        return $this->user_id;
    }

    public function setUser_id(string $user_id): void
    {
        $this->user_id = $user_id;
    }
    

    
}

?>