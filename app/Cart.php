<?php 

namespace App;

class Cart 
{
	public $items = null;
	public $totalQuantity = 0;
	public $totalPrice = 0;

	public function __construct($oldCart) 
	{
		if($oldCart) {
			$this->items = $oldCart->items;
			$this->totalQuantity = $oldCart->totalQuantity;
			$this->totalPrice = sprintf('%0.2f', $oldCart->totalPrice);
		}
	}

	public function add($item, $id) 
	{
		$storedItem = [ 'quantity' => 0, 'price' => $item->price, 'item' => $item ];
		if($this->items) {
			if(array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}
		$storedItem['quantity']++;
		$storedItem['price'] = sprintf('%0.2f', $item->price * $storedItem['quantity']);
		$this->items[$id] = $storedItem;
		$this->totalQuantity++;
		$this->totalPrice += sprintf('%0.2f', $item->price);
	}

	public function deleteItem($id) 
	{
		if($this->items) {
			if(array_key_exists($id, $this->items)) {
				$this->totalQuantity -= $this->items[$id]['quantity'];
				$this->totalPrice -= sprintf('%0.2f', $this->items[$id]['price']);
				unset($this->items[$id]);
			}
		}
	}

	public function updateQuantity($id, $quantity)
	{
		if($this->items) {
			if(array_key_exists($id, $this->items)) {
				$oldQuantity = $this->items[$id]['quantity'];
				$oldPrice = $this->items[$id]['price'];
				$this->totalQuantity -= $this->items[$id]['quantity'];
				$this->items[$id]['quantity'] = $quantity;
				$this->totalQuantity += $this->items[$id]['quantity'];
				$newPrice =sprintf('%0.2f', $oldPrice / $oldQuantity * $this->items[$id]['quantity']);
				$this->items[$id]['price'] = $newPrice;
				$newTotalPrice = $this->totalPrice-$oldPrice+$this->items[$id]['price'];
				$this->totalPrice = sprintf('%0.2f', $newTotalPrice);
			}
		}
	}
}