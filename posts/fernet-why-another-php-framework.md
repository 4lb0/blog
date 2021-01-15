# Fernet: why another PHP framework?

A long time ago PHP was cool. Now is dead. Well, <ExternalLink href="https://medium.com/madhash/is-php-dead-or-alive-611ae8e7e6e3">isn't dead yet</ExternalLink>, but it doesn't look very alive neither. This happen to Java years ago and I'm sure it will happen with JS as well.

<p align="center">
    <img src="/img/simpsonitwillhappen.jpg" alt="Abe Simpson saying It'll happen to you" />
</p>

So why do I started a new PHP framework 2021?

* I like the React approach
* To learn and use the new PHP features
* Just for fun

----

## The React approach

After many years of preaching the separation of the view and the logic in different files with MVC frameworks I was baffled when I read about React. I was suspicious at first but after I used a little bit I found I like how the component and JSX were written. It's funny because I never liked the <ExternalLink href="https://codebeforethehorse.tumblr.com/post/3288864699/basic-xhp-abstractions">XHP</a> that JSX is based on.

When I start writing <ExternalLink href="https://github.com/pragmore/fernet">Fernet</ExternalLink> try many alternatives. I first try a pseudocode similar to JSX:

```html
{user && 
	<div>
		<SomeComponent active="true" user={user}>
			Hello <strong>{user.name}</strong>
		</SomeComponent>
	</div>}
```

Parsing all this proved to be really hard. Then I figured out I don't need too much logic because PHP have a pretty decent templating system already. I want to keep it.

```php
<?php use App\Component\SomeComponent; ?>
<?php if ($user): ?>
<div>
	<?= SomeComponent::start(['email' => $user->email]) ?>
		Hello <strong><?= $user->name ?></strong>
	<?= SomeComponent::end() ?>
</div>
<?php endif ?>
```

But it felt too verbose. So I guess I reach middle ground with my last attempt.

```php
<?php if ($user): ?>
<div>
	<SomeComponent email="<?= $user->email ?>">
		Hello <strong><?= $user->name ?></strong>
	</SomeComponent>
</div>
<?php endif ?>
```

Another important thing I want to do is the event handling. This is React

```js
function ActionLink() {
  function handleClick(e) {
	e.preventDefault();
	console.log('The link was clicked.');
  }
  return (
	<a href="#" onClick={handleClick}>
	  Click me
	</a>
  );
}
```

And the same with Fernet is

```php
namespace 

use Monolog\Logger;

class ActionLink
{
	private Logger $log;

	public function __construct(Logger $log)
	{
		$this->log = $log;
	}

	public function handleClick(): void
	{
		$this->log->log("The link was clicked.");
	}

	public function __toString()
	{
		return '<a @onClick="handleClick">Click me</a>';
	} 
}  
```

It was very important the onClick called the handleClick method in the class in the same way. Of course there is no console.log in PHP so we use the frameworks log. But the rest is pretty similar. Another must feature seen here is the automatic dependency injection. This is implemented with the <ExternalLink href="https://container.thephpleague.com/3.x/auto-wiring/">autowiring in Container</ExternalLink> the dependency injection container developed by The PHP League.

## New PHP features (version 7+)

I'd enjoy using Typescript in the past with an old Angular project so I want to try strict typing again. Since a few years I've been using type hinting in PHP as much as possible although it doesn't made any sense without scalar types.

I don't care too much about suporting older PHP versions. Fernet is developed with version 7.4 and the same with the apps that uses the framework.

## Devs just want to have fun 

<p align="center">
    <img src="https://media.giphy.com/media/28HuTvEHje7v1ngGAm/giphy.gif" alt="The IT Crowd gang having fun" />
</p>

Of course having fun is another must feature. I do love my job as a team leader but I don't have many oportunities to code whatever I want. I'm enjoying too much so far when I'm writing code and when I'm thinking in new ways to develop a PHP app.
