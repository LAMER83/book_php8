 <?php
 class ShopProductWriter
 {
     private $products = [];
     public function addProduct(ShopProduct $shopProduct): void
     {
         $this->products[] = $shopProduct;
     }
     public function write(): void
     {
         $str = "";
         foreach ($this->products as $shopProduct)
         {
             $str .= "{$shopProduct->title}: ";
             $str .= $shopProduct->getProducer();
             $str .= " ({$shopProduct->getPrice()})\n";
         }
         print $str;
     }
 }

class ShopProduct
{
    /*public $title;
    public $producerMainName;
    public $producerFirstName;
    protected $price;*/
    private int | float $discont = 0;

    public function __construct(private string $title,
                                private string $producerFirstName,
                                private string $producerMainName,
                                protected int | float $price)
    {
        $this->title = $title;
        $this->producerFirstName = $producerFirstName;
        $this->producerMainName = $producerMainName;
        $this->price = $price;
    }
    public function getProducerFirstName(): string
    {
        return $this->producerFirstName;
    }
    public function getProducerMainName():string
    {
        return $this->producerMainName;
    }
    public function setDiscount(int | float $num): void
    {
        $this->discont = $num;
    }

    public function getDiscount(): int
    {
        return $this->discont;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int | float
    {
        return ($this->price - $this->discont);
    }
    public function getProducer():string
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



class CDProduct extends ShopProduct
{

    public function __construct(string $title,
                                string $firstName,
                                string $mainName,
                                int | float $price,
                                private int $playLenght)
    {
        parent::__construct($title, $firstName, $mainName, $price);
    }

    public function getPlayLenght(): int
    {
        return $this->playLenght;
    }

    public function getSummaryLine(): string
    {

        $base = " ({$this->produserMainName}, ";
        $base .= "{$this->produserFirstName} )";
        $base .= ": Время звучания - {$this->playLenght}";
        return $base;
    }

}

 class BookProduct extends ShopProduct
 {
     //public $numPages;

     public function __construct(string $title,
                                 string $firstName,
                                 string $mainName,
                                 int | float $price,
                                 private int $numPages)
     {
         parent::__construct($title, $firstName, $mainName, $price);
         //$this->numPages = $numPages;
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
     public function getPrice(): int | float
     {
         return ($this->price);
     }


 }

$avtor = new CDProduct("Книга", "Михайл", "Булгаков", 5.00, 10);
//print $avtor->getProducer();
print $avtor->getSummaryLine();