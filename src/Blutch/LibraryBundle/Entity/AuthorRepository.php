<?php

namespace Blutch\LibraryBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AuthorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AuthorRepository extends EntityRepository {

	public function getAuthors() {
		$query = $this->createQueryBuilder("a")
			->orderBy("a.lastName", "ASC")
			->orderBy("a.firstName", "ASC")
			->getQuery();
		
		return $query->getResult();
	}
	
	public function getAuthor($id) {
		$query = $this->createQueryBuilder("a")
			->leftJoin("a.books", "b")
			->addSelect("b")
			->where("a.id = :id")
			->setParameter("id", $id)
			->orderBy("b.title", "ASC")
			->getQuery();
		
		return $query->getSingleResult();
	}

}