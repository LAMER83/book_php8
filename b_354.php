 <?php
class ShopProduct
{
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }
    public function getProducer(): string
    {
        return $this->producerFirstName . " " . $this->producerMainName;
    }
    public function getSummaryLine(): string
    {
        $base = "{$this->title} ({$this->producerMainName}, ";
        $base .= "{$this->producerFirstName} )";
        return $base;
    }
}

class BookProduct extends ShopProduct
{
    public $numPages;

    public function __construct(string $title, string $firstName, string $mainName, float $price, int $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    public function getNumberOfPages(): int
    {
        return $this->numPages;
    }

    public function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= ": {$this->numPages} стр.";
        return $base;
    }


}

class CDProduct extends ShopProduct
{
    public $playLenght;


    public function __construct(string $title, string $firstName, string $mainName, float $price, int $playLenght)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLenght = $playLenght;
    }

    public function getPlayLenght(): int
    {
        return $this->playLenght;
    }

    public function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - {$this->playLenght}";
        return $base;
    }

}

$avtor = new CDProduct("Книга", "Михайл", "Булгаков", 5.00, 10);
//print $avtor->getProducer();
print $avtor->getSummaryLine();