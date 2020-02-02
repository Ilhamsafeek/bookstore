<?php

namespace ShoppingCartBundle\Repository;

use ShoppingCartBundle\Entity\Coupon;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * CartRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartRepository extends \Doctrine\ORM\EntityRepository
{
    function getSessionID()
    {
        return md5(time());
    }

    function isBookExist($Book, $SessionId)
    {
        $em = $this->createQueryBuilder('b');

        $result = $em->andWhere('b.sessionId = :session_id')
            ->setParameter('session_id', $SessionId)
            ->andWhere('b.book = :books')
            ->setParameter('books', $Book->getId())->getQuery()->getResult();


        return $result[0] ?? false;
    }

    function getCart($SessionId)
    {

        $em = $this->createQueryBuilder('b');

        $result = $em->andWhere('b.sessionId = :session_id')
            ->setParameter('session_id', $SessionId)->getQuery()->getResult();

        return $result;
    }

    function getPrice($SessionId)
    {

        $Cart = $this->getCart($SessionId);
        $data['sub_total'] = 0;
        $data['total'] = 0;
        $data['count'] = 0;
        $data['discount'] = 0;
        $data['category'] = [];
        $data['total_books'] = 0;
        $data['each_cat_discount'] = true;

        foreach ($Cart as $cartItem) {

            //getting no book in each books category
            empty($data['category'][$cartItem->getBook()->getCategory()->getId()]['count']) ?
                $data['category'][$cartItem->getBook()->getCategory()->getId()]['count'] = $cartItem->getQty() :
                $data['category'][$cartItem->getBook()->getCategory()->getId()]['count'] += $cartItem->getQty();

            //getting discount details
            $data['category'][$cartItem->getBook()->getCategory()->getId()]['discount'] = $cartItem->getBook()->getCategory()->getDiscount();
            $data['category'][$cartItem->getBook()->getCategory()->getId()]['discount_book_count'] = $cartItem->getBook()->getCategory()->getDiscountBookCount();

            //getting total values for each category
            $data['category'][$cartItem->getBook()->getCategory()->getId()]['total_price'] = (
                ($data['category'][$cartItem->getBook()->getCategory()->getId()]['total_price'] ?? 0) +
                ($cartItem->getBook()->getPrice() * $cartItem->getQty()));


            $data['total_books'] += $cartItem->getQty();
        }

        //generate category  discount
        foreach ($data['category'] as $categoryID => $categoryItem) {

            //category wise discount
            if ($categoryItem['count'] >= $categoryItem['discount_book_count']) {
                $data['category'][$categoryID]['discount_value'] = $categoryItem['total_price'] * ($categoryItem['discount'] / 100);
                $data['discount'] += $data['category'][$categoryID]['discount_value'];
            }
            $data['sub_total'] += $categoryItem['total_price'];


            //if more than 10 books from each category
            if ($categoryItem['count'] < 10)
                $data['each_cat_discount'] = false;
        }
        //if each category has more than 10 books
        if ($data['each_cat_discount']) {
            $data['discount'] += $data['sub_total'] * (5 / 100);
        }


        //coupon
        $session = new Session();
        $coupon = $session->get('coupon');
        $em = $this->getEntityManager()->getRepository(Coupon::class);

        $couponDiscount = $em->findBy(['coupon' => $coupon]);

        if (!empty($couponDiscount[0])) {
            $data['discount'] = $data['sub_total'] * ($couponDiscount[0]->getDiscount() / 100);
        }

        //generate total
        $data['total'] = $data['sub_total'] - $data['discount'];

        return $data;

    }

}