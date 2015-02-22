<?php
class Book {
    public $Id = "";
    public $Title = "";
    public $Auther = "";
    public $ImageSource = "";
    public $Description = "";
    public $Isbn = "";
    public $AmazonLink = "";
    public $Active = "";
    public $Started = "";
    public $Finished = "";
    public $Review = "";
    public $Rating = "";
}

function getReadingList(&$books) {	
    $book = new Book();
    $book->Title = "Soft Skills";
    $book->Auther = "John Sonmez";
    $book->ImageSource = "http://ecx.images-amazon.com/images/I/A1tYa0EpiyL.jpg";
    $book->Description = "A unique guide, offering techniques and practices for a more satisfying life as a professional software developer. In it, developer and life coach John Sonmez addresses a wide range of important 'soft' topics, from career and productivity to personal finance and investing, and even fitness and relationships, all from a developer-centric viewpoint.";
		
    $book2 = new Book();
    $book2->Title = "The Camel Club";
    $book2->Auther = "David Baldacci";
    $book2->ImageSource = "http://ecx.images-amazon.com/images/I/51H3rIzrBnL.jpg";
    $book2->Description = "The man known as Oliver Stone has no official past. He spends most days camped opposite the White House, hoping to expose corruption wherever he finds it. But the stakes are raised when he and his friends, a group of conspiracy theorist misfits known as The Camel Club, accidentally witness the murder of an intelligence analyst. Especially when the authorities are seemingly happy to write it off as a suicide.";
	
	$books = array($book, $book2);
}