<H1>Главная страница</H1>

<?php
foreach ($news as $value) {
	echo '<h3>'.$value['title'].'</h3>';
	echo '<p>'.$value['description'].'</p>';
	echo "<hr>";
}

?>

<div id="example_text">
	<p class="block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, beatae, cumque, dolor reprehenderit vitae voluptatibus qui inventore harum itaque odio at rerum quasi veritatis nisi ducimus. Ducimus, facere quam voluptate!</p>
	<p class="block">Lorem ipsum dolor sit amet.</p>
	<p class="block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, fugit, voluptatem, suscipit accusantium id molestiae eos natus pariatur tenetur dolores ea commodi quo autem minus est praesentium repellat. Explicabo, non, magni, repellat, illo culpa rerum deleniti reprehenderit ad veniam velit voluptatum ipsa quia corporis necessitatibus molestiae et consequuntur alias nisi doloribus accusamus beatae laborum cupiditate iste ducimus dolorem provident quas minus ipsum adipisci voluptate ea illum suscipit esse blanditiis officiis natus omnis aliquam eos vitae praesentium. Vero, possimus, consequuntur expedita numquam nostrum voluptatum amet minus dignissimos eius quam debitis ipsum autem quod consectetur dolorum incidunt veniam dicta architecto sunt voluptatem.</p>
</div>