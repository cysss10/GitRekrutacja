<?php


namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BlogBundle\Libs\Utils;


/**
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
 * @ORM\Table(name="blog_posts")
 * @ORM\HasLifecycleCallbacks
 */
class Posts
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=120, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(name="second_title", type="string", length=150, nullable=true)
     */
    private $secondTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $author;

    /**
     * @ORM\OneToMany(
     *      targetEntity = "Comments",
     *      mappedBy = "post"
     * )
     *
     * @ORM\OrderBy({"createDate" = "DESC"})
     *
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createDate = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Posts
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set secondTitle
     *
     * @param string $secondTitle
     *
     * @return Posts
     */
    public function setSecondTitle($secondTitle)
    {
        $this->secondTitle = $secondTitle;

        return $this;
    }

    /**
     * Get secondTitle
     *
     * @return string
     */
    public function getSecondTitle()
    {
        return $this->secondTitle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Posts
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Posts
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Posts
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Posts
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add comment
     *
     * @param \BlogBundle\Entity\Comments $comment
     *
     * @return Posts
     */
    public function addComment(\BlogBundle\Entity\Comments $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \BlogBundle\Entity\Comments $comment
     */
    public function removeComment(\BlogBundle\Entity\Comments $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preSave()
    {
        if(null === $this->slug){
            $this->setSlug($this->getTitle());
        }
    }
}
