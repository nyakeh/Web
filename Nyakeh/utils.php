<?php
class Book {
    public $Id = "";
    public $Title = "";
    public $Auther = "";
    public $Isbn = "";
    public $Started = "";
    public $Finished = "";
    public $Publish = "";
    public $Active = "";
    public $Description = "";
    public $Review = "";
    public $Rating = "";
}

function getReadingList(&$books) {	
    $book = new Book();
    $book->Title = "Soft Skills";
    $book->Auther = "John Sonmez";
    $book->Description = "A unique guide, offering techniques and practices for a more satisfying life as a professional software developer. In it, developer and life coach John Sonmez addresses a wide range of important 'soft' topics, from career and productivity to personal finance and investing, and even fitness and relationships, all from a developer-centric viewpoint.";
	
	$books = array($book, $book, $book);
}