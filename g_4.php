 <?php
//INSERT INTO products (id, type, firstname, mainname, title, price, numpages, playlength, discount)
 //VALUES(1, "book", "Михайл", "Булгаков", "Мастер и Маргарита", 5, 666, 0, 1);
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

    private int | float $discont = 0;
    private int $id = 0;

    public function setID(int $id): void
    {
        $this->id - $id;
    }

    public static function getInstance(int $id, \PDO $pdo): ShopProduct
    {
        $stmt = $pdo->prepare("select * from products where id=?");
        $result = $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (empty($row))
        {
           return print "Ничего";
        }

        if ($row['type'] == "book")
        {
            $product = new BookProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                (float) $row['price'],
                (int) $row['numpages']
            );
            echo "DD";
        }
        elseif ($row['type'] == "cd")
        {
                $product = new CDProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                (float) $row['price'],
                (int) $row['playlength']
            );
        }
        else
        {
            $firstname = (is_null($row['firstname'])) ? "" : $row['firstname'];
            $product = new ShopProduct($row['title'],
                                        $firstname,
                                        $row['mainname'],
                                        (float) $row['price']);
        }
        $product->setID((int) $row['id']);
        $product->setDiscount((int) $row['discount']);
        return $product;
    }

    public function __construct(private string $title,
                                private string $producerFirstName,
                                private string $producerMainName,
                                protected int | float $price)
    {

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

        $base = " ({$this->getProducerMainName()}, ";
        $base .= "{$this->getProducerFirstName()} )";
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

//$avtor = new CDProduct("Книга", "Михайл", "Булгаков", 5.00, 10);
//print $avtor->getProducer();
 //$avtor->setDiscount(2);
 //$avtor->getTitle();
//print $avtor->getSummaryLine();

 $dsn = "sqlite:db/db.sqlite3";

 $pdo = new \PDO($dsn, null, null);

 $pdo->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $obj = ShopProduct::getInstance(3, $pdo);