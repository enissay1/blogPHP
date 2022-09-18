<?php

namespace App\Entity;

class Post
{
  private $id;
  private $title;
  private $createdAt;
  private $publishedAt;
  private $description;
  private $cover;
  private $id_category;
  private $id_user;

  /**
   * Get 10 words from description
   */
  public function getExcept()
  {
    return substr($this->description, 0, 10);
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of title
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of publishedAt
   */
  public function getPublishedAt()
  {
    return $this->publishedAt;
  }

  /**
   * Set the value of publishedAt
   *
   * @return  self
   */
  public function setPublishedAt($publishedAt)
  {
    $this->publishedAt = $publishedAt;

    return $this;
  }

  /**
   * Get the value of description
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of cover
   */
  public function getCover()
  {
    return $this->cover;
  }

  /**
   * Set the value of cover
   *
   * @return  self
   */
  public function setCover($cover)
  {
    $this->cover = $cover;

    return $this;
  }

  /**
   * Get the value of id_category
   */ 
  public function getId_category()
  {
    return $this->id_category;
  }

  /**
   * Get the value of id_user
   */ 
  public function getId_user()
  {
    return $this->id_user;
  }
}
