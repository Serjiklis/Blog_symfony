<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Post $post = null;

	#[ORM\Column(type: Types::DATETIME_MUTABLE)]
	private ?\DateTimeInterface $created = null;

	#[ORM\Column(type: Types::DATETIME_MUTABLE)]
	private ?\DateTimeInterface $updated = null;

	/**
	 * @return \DateTimeInterface|null
	 */
	public function getCreated(): ?\DateTimeInterface
	{
		return $this->created;
	}

	/**
	 * @param \DateTimeInterface|null $created
	 */
	public function setCreated(?\DateTimeInterface $created): void
	{
		$this->created = $created;
	}

	/**
	 * @return \DateTimeInterface|null
	 */
	public function getUpdated(): ?\DateTimeInterface
	{
		return $this->updated;
	}

	/**
	 * @param \DateTimeInterface|null $updated
	 */
	public function setUpdated(?\DateTimeInterface $updated): void
	{
		$this->updated = $updated;
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
