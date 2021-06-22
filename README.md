# Agile Design Patterns

_An accepted solution for a common problem_

## Creational design patterns

### Factory Method Pattern

- **Intent**
    - Define an interface for creating an object, but let subclasses decide which class to instantiate. Factory Method
      lets a class defer instantiation to subclasses.
    - Defining a "virtual" constructor.
    - The new operator considered harmful.
- **Check list**
    1. If you have an inheritance hierarchy that exercises polymorphism, consider adding a polymorphic creation
       capability by defining a `static` factory method in the base class.
    2. Design the arguments to the factory method. What qualities or characteristics are necessary and sufficient to
       identify the correct derived class to instantiate?
    3. Consider designing an internal "object pool" that will allow objects to be reused instead of created from
       scratch.
    4. Consider making all constructors `private` or `protected`.
- **When**: Use a Factory Pattern when you find yourself writing code to gather information necessary to create objects.
- **Why**: Factories help to contain the logic of object creation in a single place. They can also break dependencies to
  facilitate loose coupling and dependency injection to allow for better testing.

### Singleton Pattern

- **Intent**
    - Ensure a class has only one instance, and provide a global point of access to it.
    - Encapsulated "just-in-time initialization" or "initialization on first use".
- **Check list**
    1. Define a private static attribute in the "single instance" class.
    2. Define a public static accessor function in the class.
    3. Do "lazy initialization" (creation on first use) in the accessor function.
    4. Define all constructors to be protected or private.
    5. Clients may only use the accessor function to manipulate the Singleton.
- **When**: You need to achieve singularity and want a cross platform, lazily evaluated solution which also offers the
  possibility of creation through derivation.
- **Why**: To offer a single point of access when needed.
- **Example**

```php
class Singleton
{
    private static $instance;

    private function __construct()
    {
        // Complicated process
    }

    public static function getInstance()
    {
        if (! (static::$instance instanceof Singleton)) {
            static::$instance = new Singleton;
        }

        return static::$instance;
    }
}
```

### Monostate Pattern

- **When**: Transparency, derivabitility, and polymorphism are preferred together with singularity.
- **Why**: To hide from the users/clients the fact that the object offers singularity.
- **Example**

```php
class Monostate
{
    private static $value;

    public function setValue($value)
    {
        static::$value = $value;
    }

    public function getValue()
    {
        return static::$value;
    }
}
```

## Structural patterns

### Adapter Pattern

- **Intent**
    - Convert the interface of a class into another interface clients expect. Adapter lets classes work together that
      couldn't otherwise because of incompatible interfaces.
    - Wrap an existing class with a new interface.
    - Impedance match an old component to a new system
- **When**: You need to create a connection with a pre-existing and potentially changing module, library, or API.
- **Why**: To allow your business logic to rely only on the public methods the adapter offers, and permit changing the
  other side of the adapter easily.
- **Check list**
    1. Identify the players: the component(s) that want to be accommodated (i.e. the client), and the component that
       needs to adapt (i.e. the adaptee).
    2. Identify the interface that the client requires.
    3. Design a "wrapper" class that can "impedance match" the adaptee to the client.
    4. The adapter/wrapper class "has a" instance of the adaptee class.
    5. The adapter/wrapper class "maps" the client interface to the adaptee interface.
    6. The client uses (is coupled to) the new interface

### Bridge Pattern

- **When**: The adapter pattern is not enough, and you change classes on both sides of the pipe.
- **Why**: To offer increased flexibility at the cost of significant complexity.
- **Structure** ![Bridge Pattern's Structure](https://sourcemaking.com/files/v2/content/patterns/Bridge___-2x.png)
- **Check List**
    1. Decide if two orthogonal dimensions exist in the domain. These independent concepts could be:
       abstraction/platform, or domain/infrastructure, or front-end/back-end, or interface/implementation.
    2. Design the separation of concerns: what does the client want, and what do the platforms provide.
    3. Design a platform-oriented interface that is minimal, necessary, and sufficient. Its goal is to decouple the
       abstraction from the platform.
    4. Define a derived class of that interface for each platform.
    5. Create the abstraction base class that "has a" platform object and delegates the platform-oriented functionality
       to it.
    6. Define specializations of the abstraction class if desired.
- **Example**

```php
abstract class Switcher
{
    protected $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function On()
    {
        return $this->device->On();
    }

    public function Off()
    {
        return $this->device->Off();
    }
}

abstract class Device
{
    protected $isOn = false;

    public function On()
    {
        $this->isOn = true;
    }

    public function Off()
    {
        $this->isOn = false;
    }
}

class Tv extends Device
{
    private $channel;

    public function On()
    {
        $this->isOn = true;
        $this->channel = 1;
    }

    public function Off()
    {
        $this->isOn = false;
        $this->channel = 2;
    }
}

class Lamp extends Device
{
    private $lightColor = 'blue';

    public function On()
    {
        $this->isOn = true;
        $this->lightColor = 'green';
    }

    public function Off()
    {
        $this->isOn = false;
        $this->lightColor = 'blue';
    }
}
```

### Composit Pattern

- **Intent**
    - Compose objects into tree structures to represent whole-part hierarchies. Composite lets clients treat individual
      objects and compositions of objects uniformly.
    - Recursive composition
    - "Directories contain entries, each of which could be a directory."
      1-to-many "has a" up the "is a" hierarchy
- **When**: You have to apply an action to several similar objects.
- **Why**: To reduce duplication and simplify how similar objects are called.
- **Structure** ![Composite Pattern's Structure](https://sourcemaking.com/files/v2/content/patterns/Composite-2x.png)
- **Check List**
    1. Ensure that your problem is about representing "whole-part" hierarchical relationships.
    2. Consider the heuristic, "Containers that contain containees, each of which could be a container." For example, "
       Assemblies that contain components, each of which could be an assembly." Divide your domain concepts into
       container classes, and containee classes.
    3. Create a "lowest common denominator" interface that makes your containers and containees interchangeable. It
       should specify the behavior that needs to be exercised uniformly across all containee and container objects.
    4. All container and containee classes declare an "is a" relationship to the interface.
    5. All container classes declare a one-to-many "has a" relationship to the interface.
    6. Container classes leverage polymorphism to delegate to their containee objects.
    7. Child management methods [e.g. addChild(), removeChild()] should normally be defined in the Composite class.
       Unfortunately, the desire to treat Leaf and Composite objects uniformly may require that these methods be
       promoted to the abstract Component class. See the Gang of Four for a discussion of these "safety" versus "
       transparency" trade-offs.
- **Example**

```php
// Step 3
interface Component
{
	public function doThis();
}

class Leaf implements Component
{
	public function doThis()
	{
		// Something
	}
}

class Composite implements Component
{
	// Step 5: a one-to-many "has a" relationship
	private $elements = [];

	// Step 7
	public function addElement(Component $element)
	{
		$this->elements[] = $element;
	}

	// Step 4: "is a" relationship
	public function doThis()
	{
		foreach($this->elements as $element) {
			$element->doThis(); // Step 6
		}
	}
}
```

### Decorator Pattern

- **Intent**
    - Attach additional responsibilities to an object dynamically. Decorators provide a flexible alternative to
      subclassing for extending functionality.
    - Client-specified embellishment of a core object by recursively wrapping it.
    - Wrapping a gift, putting it in a box, and wrapping the box.
- **Structure** ![Decorator Pattern's Structure](https://sourcemaking.com/files/v2/content/patterns/Decorator__1-2x.png)
- **Check list**
    1. Ensure the context is: a single core (or non-optional) component, several optional embellishments or wrappers,
       and an interface that is common to all.
    2. Create a "Lowest Common Denominator" interface that makes all classes interchangeable.
    3. Create a second level base class (Decorator) to support the optional wrapper classes.
    4. The Core class and Decorator class inherit from the LCD interface.
    5. The Decorator class declares a composition relationship to the LCD interface, and this data member is initialized
       in its constructor.
    6. The Decorator class delegates to the LCD object.
    7. Define a Decorator derived class for each optional embellishment.
    8. Decorator derived classes implement their wrapper functionality - and - delegate to the Decorator base class.
    9. The client configures the type and ordering of Core and Decorator objects.
- **When**: You can't change old classes, but you have to implement new behavior or state.
- **Why**: It offers an unintrusive way of adding new functionality.
- **Example**

```php
interface Present
{
	public function show();
}

class Gift implements Present
{
	public function show()
	{
		return 'A gift from God!';
	}
}

abstract class Decorator implements Present
{
	protected $present;

	public function __construct(Present $present)
	{
		$this->present = $present;
	}

	public function show()
	{
		return $this->present->show();
	}
}

class Package extends Decorator
{
	public function pack()
	{
		return "Packed by Package: {$this->show()}";
	}
}
```

### Facade Pattern

- **Intent**
    - Provide a unified interface to a set of interfaces in a subsystem. Facade defines a higher-level interface that
      makes the subsystem easier to use.
    - Wrap a complicated subsystem with a simpler interface.
- **When**: To simplify your API or intentionally conceal inner business logic.
- **Why**: You can control the API and the real implementations and logic independently.
- **Check List**
    1. Identify a simpler, unified interface for the subsystem or component.
    2. Design a 'wrapper' class that encapsulates the subsystem.
    3. The facade/wrapper captures the complexity and collaborations of the component, and delegates to the appropriate
       methods.
    4. The client uses (is coupled to) the Facade only.
    5. Consider whether additional Facades would add value.
- **Example**

```php
class StubsFacade
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function findStubs($input)
    {
        // Do job A
        // Do job B
        // Do job C
        $result = 'some values...';
        // Do job N

        return $result;
    }
}
```

### Proxy Pattern

- **When**: You have to retrieve information from a persistence layer or external source, but don't want your business
  logic to know this.
- **Why**: To offer a non-intrusive approach to creating objects behind the scenes. It also opens the possibility to
  retrieve these object on the fly, lazily, and from different sources.
- **Check List**
    1. Identify the leverage or "aspect" that is best implemented as a wrapper or surrogate.
    2. Define an interface that will make the proxy and the original component interchangeable.
    3. Consider defining a `Factory` that can encapsulate the decision of whether a proxy or original object is
       desirable.
    4. The wrapper class holds a pointer to the real class and implements the interface.
    5. The pointer may be initialized at construction, or on first use.
    6. Each wrapper method contributes its leverage, and delegates to the wrappee object.
- **Example**
```php
interface Animal
{
    public function run();
}

class Cat implements Animal
{
    public function run()
    {
        return 'Cat is running';
    }

    public function meow()
    {
        return 'Cat is meowing';
    }
}

class CatProxy implements Animal
{
    private $cat;

    public function run()
    {
        if (is_null($this->cat))
            $this->cat = new Cat;

        return $this->cat->run();
    }

    // CatProxy only provides run() method and hide another unwanted to know methods
}
```

### Abstract Server Pattern

- **When**: You need to connect objects and maintain flexibility.
- **Why**: Because it is the simplest way to achieve flexibility, while respecting both the dependency inversion
  principle and the open close principle.
- **Example**

```php
interface Animal
{
    public function run();
}

class Cat implements Animal
{
    public function run()
    {
        return 'Cat is running';
    }
}

class Dog implements Animal
{
    public function run()
    {
        return 'Dog is running';
    }
}

class ZooKeeper
{
    private $animal;

    public function __construct(Animal $animal)
    {
        $this->animal = $animal;
    }

    public function letItOut()
    {
        $this->animal->run();
    }
}
```

## Behavioral patterns

### Command Pattern

- **Intent**
    - Encapsulate a request as an object, thereby letting you parameterize clients with different requests, queue or log
      requests, and support undoable operations.
    - Promote "invocation of a method on an object" to full object status
    - An object-oriented callback
- **Problem**: Need to issue requests to objects without knowing anything about the operation being requested or the
  receiver of the request.
- **When**: When you have to perform many operations to prepare objects for use.
- **Check list**
    - Define a Command interface with a method signature like execute().
    - Create one or more derived classes that encapsulate some subset of the following: a "receiver" object, the method
      to invoke, the arguments to pass.
    - Instantiate a Command object for each deferred execution request.
    - Pass the Command object from the creator (aka sender) to the invoker (aka receiver).
    - The invoker decides when to execute().
- **Why**: To move complexity from the consuming code to the creating code.
- **Example**

```php
interface Command
{
    public function execute();
}

class MakeDirectoryCommand implements Command
{
    private $dirname;

    public function __construct($dirname)
    {
            $this->dirname = $dirname;
    }

    public function execute()
    {
        return exec("mkdir {$this->dirname}");
    }
}

class ListCommand implements Command
{
    public function execute()
    {
        return `ls -al`;
    }
}

class CommandCreator
{
    /*
     * @return Command
     */
    public function createCommand($commandName, $args)
    {
        switch($commandName) {
            case 'mkdir':
                return new MakeDirectoryCommand($args['dir_name']);
                break;

                case 'ls':
                    return new ListCommand();

                default:
                    throw new InvalidArgumentException("Can't create command: $commandName");
        }
    }
}

class Program
{
    private $creator;

    public function __construct(CommandCreator $creator)
    {
        $this->creator = $creator;
    }

    public function mkdir()
    {
            $command = $this->creator->createCommand('mkdir');
            $command->execute();
    }

    public function ls()
    {
            $command = $this->creator->createCommand('ls');
            $command->execute();
    }
}
```

### Mediator Pattern

- **Intent**
    - Define an object that encapsulates how a set of objects interact. Mediator promotes loose coupling by keeping
      objects from referring to each other explicitly, and it lets you vary their interaction independently.
    - Design an intermediary to decouple many peers.
    - Promote the many-to-many relationships between interacting peers to "full object status".
- **When**: The affected objects can not know about the observed objects.
- **Why**: To offer a hidden mechanism of affecting other objects in the system when one object changes.
- **Example**

```php
class Mediator
{
    private $observered;

    private $afftecter;

    public function __construct(Observable $observered, Affecter $afftecter)
    {
        $this->observered = $observered;
        $this->afftecter = $afftecter;
    }

    public function update($stub)
    {
        $this->affecter->setStub($stub);
    }
}

abstract class Observable
{
    protected $observers = [ ];

    public function register(Mediator $observer)
    {
        $this->observers[] = $observer;
    }

    public function unregister(Mediator $observer)
    {
        foreach ($this->observers as $index => $o) {
            if ($observer === $o) {
                unset( $this->observers[$index] );
            }
        }
        }

    public function notify(Observable $other)
    {
        foreach ($this->observers as $observer) {
            $observer->update($other);
        }
    }
}

class Observered extends Observable
{
    private $stub;

    public function setStub($stub)
    {
        $this->stub = $stub;

        $this->notify($stub);
    }
}

interface Affecter
{
    public function setStub($stub);
}

class Affected implements Affecter
{
    private $stub;

    public function setStub($stub)
    {
        $this->stub = $stub;
    }
}
```

### Null Pattern

- **Intent**: The intent of a Null Object is to encapsulate the absence of an object by providing a substitutable
  alternative that offers suitable default do nothing behavior. In short, a design where "nothing will come of nothing"
- **When**:
    - You frequently check for null or you have refused bequests.
    - An object requires a collaborator. The Null Object pattern does not introduce this collaboration – it makes use of
      a collaboration that already exists
    - Some collaborator instances should do nothing
    - You want to abstract the handling of null away from the client
- **Why**: It can add clarity to your code and forces you to think more about the behavior of your objects.
- **Structure**
    - _Client_ — requires a collaborator.
    - _AbstractObject_
        - declares the interface for Client's collaborator
        - implements default behavior for the interface common to all classes, as appropriate
    - _RealObject_ — defines a concrete subclass of `AbstractObject` whose instances provide useful behavior
      that `Client` expects
    - _NullObject_
        - provides an interface identical to AbstractObject's so that a null object can be substituted for a real object
        - implements its interface to do nothing. What exactly it means to do nothing depends on what sort of
          behavior `Client` is expecting
        - when there is more than one way to do nothing, more than one `NullObject` class may be required

### Observer Pattern

- **Intent**:
    - In the Observer pattern a `subject` object will _notify_ an `observer` object if the subject's state _changes_.
    - Define a one-to-many dependency between objects so that when one object changes state, all its dependents are
      notified and updated automatically.
    - Encapsulate the core (or common or engine) components in a Subject abstraction, and the variable (or optional or
      user interface) components in an Observer hierarchy.
    - The "View" part of Model-View-Controller.
- **Types**:
    - **Polling** – Objects accept subscribers. Subscribers observe the object and are notified on specific events.
      Subscribers ask the observed objects for more information in order to take an action.
    - **Push** – Like the polling method, objects accept subscribers, and subscribers are notified when an event occurs.
      But when a notification happens, the observer also receives a hint that the observer can act on.
- **When**: To provide a notification system inside your business logic or to the outside world.
- **Why**: The pattern offers a way to communicate events to any number of different objects.
- **Check list**
    1. Differentiate between the core (or independent) functionality and the optional (or dependent) functionality.
    2. `Model` the independent functionality with a "subject" abstraction.
    3. `Model` the dependent functionality with an "observer" hierarchy.
    4. The `Subject` is coupled only to the `Observer` base class.
    5. The client configures the number and type of Observers.
    6. Observers register themselves with the Subject.
    7. The `Subject` broadcasts events to all registered Observers.
    8. The `Subject` may `push` information at the Observers, or, the Observers may `pull` the information they need
       from the Subject.
- **Example**

```php
interface Observer
{
    public function onUpdate(Subject $subject);
}

abstract class Observable
{
    private $observers = [];

    public function register(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function unregister(Observer $observer)
    {
        foreach($this->observers as $index => $o) {
            if ($observer === $o) {
                unset($this->observers[$index]);
            }
        }
    }

    public function notify()
    {
        foreach($this->observers as $observer) {
            $observer->onUpdate($this);
        }
    }
}

class User extends Observable
{
    private $username;

    public function setUsername($username)
    {
        $this->username = $username;
        $this->notify();
    }
}

class Notifier implements Observer
{
    public function onUpdate(Subject $subject)
    {
        $this->pushNotification("Informations of user has been changed!");
    }

    private function pushNotification($message)
    {
        Log::info($message);
    }
}
```

### State Pattern

- **Intent**
    - Allow an object to alter its behavior when its internal state changes. The object will appear to change its class.
    - An object-oriented state machine (FSM)
    - Wrapper + Polymorphic wrapper + Collaboration
- **When**: FSM-like logic is required to be implemented.
- **Why**: To eliminate the problems of a switch...case statement, and to better encapsulate the meaning of each
  individual state.
- **Check list**
    1. Identify an existing class, or create a new class, that will serve as the "state machine" from the client's
       perspective. That class is the "wrapper" class.
    2. Create a State base class that replicates the methods of the state machine interface. Each method takes one
       additional parameter: an instance of the wrapper class. The State base class specifies any useful "default"
       behavior.
    3. Create a State derived class for each domain state. These derived classes only override the methods they need to
       override.
    4. The wrapper class maintains a "current" State object.
    5. All client requests to the wrapper class are simply delegated to the current State object, and the wrapper
       object's this pointer is passed.
    6. The State methods change the "current" state in the wrapper object as appropriate.
- **Example**

```php
interface Context
{
    public function next();

    public function setState(State $state);
}

abstract class State
{
    public abstract function next();
}

class FirstState extends State
{
    public function next(Context $context)
    {
            $context->setState(new SecondState);
    }
}

class SecondState extends State
    {
        public function next(Context $context)
        {
            $context->setState(new ThirdState);
        }
    }

    class ThirdState extends State
    {
        public function next(Context $context)
        {
            $context->setState(new ThirdState);
        }
    }

/*
 * "Wrapper" class
 */
class Client implements Context
{
    /*
     * @var State
     */
        protected $currentState;

        public function __construct(State $initialState)
        {
            $this->setState($initialState);
        }

        public function next()
        {
            $this->currentState->next($this);
        }

        public function setState(State $state)
        {
            $this->currentState = $state;
        }
}
```

### Strategy Pattern

- **When**: Flexibility and reusability is more important than simplicity.
- **Why**: Use it to implement big, interchangeable chunks of complicated logic, while keeping a common algorithm
  signature.
- **Check List**
    1. Identify an algorithm (i.e. a behavior) that the client would prefer to access through a "flex point".
    2. Specify the signature for that algorithm in an interface.
    3. Bury the alternative implementation details in derived classes.
    4. Clients of the algorithm couple themselves to the interface.
- **Example**

```php
interface Strategy
{
    public function algorithm();
}

class StrategyA
{
    public function algorithm()
    {
        // Implement plan A
    }
}

class StrategyB
{
    public function algorithm()
        {
            // Implement plan B
        }
}

class Stub
{
    public function foo(Strategy $strategy)
    {
        $strategy->algorithm();
    }
}
```

### Template Method Pattern

- **Intent**
    - Define the skeleton of an algorithm in an operation, deferring some steps to client subclasses. Template Method
      lets subclasses redefine certain steps of an algorithm without changing the algorithm's structure.
    - Base class declares algorithm 'placeholders', and derived classes implement the placeholders.
- **When**: Eliminate duplication in a simple way.
- **Why**: There is duplication and flexibility is not a problem.
- **Check List**
    1. Examine the algorithm, and decide which steps are standard and which steps are peculiar to each of the current
       classes.
    2. Define a new abstract base class to host the "don't call us, we'll call you" framework.
    3. Move the shell of the algorithm (now called the "template method") and the definition of all standard steps to
       the new base class.
    4. Define a placeholder or "hook" method in the base class for each step that requires many different
       implementations. This method can host a default implementation – or – it can be defined as abstract (Java) or
       pure virtual (C++).
    5. Invoke the hook method(s) from the template method.
    6. Each of the existing classes declares an "is-a" relationship to the new abstract base class.
    7. Remove from the existing classes all the implementation details that have been moved to the base class.
    8. The only details that will remain in the existing classes will be the implementation details peculiar to each
       derived class.
- **Example**

```php
abstract class Animal
{
    public function run()
    {
        return 'Running';
    }

    public function eat()
    {
        return 'Eating';
    }
}

class Dog
{
    public function woof()
    {
        return 'Woof Woof';
    }
}

class Cat
{
    public function meow()
    {
        return 'Meow...';
    }
}
```

### Visitor Pattern

- **When**: A decorator is not appropriate and some extra complexity is acceptable.
- **Why**: To allow and organized approach to defining functionality for several objects but at the price of higher
  complexity.
- **Check List**
    1. Confirm that the current hierarchy (known as the `Element` hierarchy) will be fairly stable and that the public
       interface of these classes is sufficient for the access the Visitor classes will require. If these conditions are
       not met, then the Visitor pattern is not a good match.
    2. Create a `Visitor` base class with a `visit(ElementXxx)` method for each `Element` derived type.
    3. Add an `accept(Visitor)` method to the `Element` hierarchy. The implementation in each `Element` derived class is
       always the same – `accept( Visitor v ) { v.visit( this ); }`. Because of cyclic dependencies, the declaration of
       the `Element` and `Visitor` classes will need to be interleaved.
    4. The `Element` hierarchy is coupled only to the `Visitor` base class, but the `Visitor` hierarchy is coupled to
       each `Element` derived class. If the stability of the `Element` hierarchy is low, and the stability of
       the `Visitor` hierarchy is high; consider swapping the 'roles' of the two hierarchies.
    5. Create a `Visitor` derived class for each "operation" to be performed on `Element` objects. `visit()`
       implementations will rely on the Element's public interface.
    6. The client creates `Visitor` objects and passes each to `Element` objects by calling `accept()`.
- **Example**

```php
interface Host
{
    public function getStubs();

    public function accept(Visitor $visitor);
}

interface Visitor
{
    public function getStubs();

    public function visit(Host $host);
}

class B implements Host
{
    public function accept(Visitor $visitor)
    {
        $visitor->visit($this);
    }

    public function getStubs()
    {
        return 'stubs';
    }
}

class A implements Visitor
{
    private $stubs;

    public function visit(Host $b)
    {
        $this->stubs = $b->getStubs();
    }

    /**
     * Get stubs of B
     */
    public function getStubs()
    {
        return $this->stubs;
    }
}
```

### Gateway Pattern

- **When**: When you need to retrieve or persist information.
- **Why**: It offers a simple public interface for complicated persistence operations. It also encapsulates persistence
  knowledge and decouples business logic from persistence logic.
- **Example**

```php
class A { }

interface Gateway
{
    public function persist(A $a);
    
    public function retrieve($id);
}

class FileGateway implements Gateway
{
    public function persist(A $a)
    {
        // TODO: Store serialized an A object to filesystem
    }
    
    public function retrieve($id)
    {
        // TODO: Retrieve an A object by its id from filesystem
    }
}

class DbGateway implements Gateway
{
    public function persist(A $a)
    {
        // TODO: Store serialized an A object to database
    }
    
    public function retrieve($id)
    {
        // TODO: Store serialized an A object to database
    }
}
```

### Active Object Pattern

- **What**: The Active Object Pattern decouples the method invocation from method execution.
- **When**: Several similar objects have to execute with a single command.
- **Why**: It forces clients to perform a single task and affect multiple objects.
- **Example**

```php
class Message
{
    private $content;
    
    public function __construct($content)
    {
        $this->content = $content;
    }
}

class Queue
{
    private $dispatcher;
    
    private $messages = [];
    
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    
    public function enqueue(Message $message)
    {
        $this->messages[] = $message;
        
        $this->dispatcher->notify();
    }
    
    public function dequeue()
    {
        return array_shift($this->messages);
    }
}

class Dispatcher
{
    public function notify()
    {
        // Spawn new Servant for each method call
        $servant = new Servant();
        $servant->start();
        
        // Do another things
        
        $servant->wait(function ($type, $buffer) {
            // Return job result
        });
    }
}

class Servant extends Process
{
    // For example, we simply declare Servant extends Process from symfony/process package to it can run asynchronously.
}

interface Proxy
{
    public function visitUrl($url);
}

class HttpProxy
{
    private $queue;
    
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }
    
    public function visitUrl($url)
    {
        $message = new Message($url);
        
        $this->queue->enqueue($message);
    }
}
```

### Event Dispatcher Pattern

- **Example**

```php
interface SenderInterface {}

class EventManager
{
    private $listeners = [];
    
    public function listen($event, $callback)
    {
        $this->listeners[$event][] = $callback;
    }
    
    public function dispatch($event, SenderInterface $sender)
    {
        foreach($this->listeners[$event] as $listener) {
            call_user_func($listener, $sender);
        }
        
    }
}

class BlogPublisher implements SenderInterface
{
    private $eventManager;
    private $title;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->eventManager->dispatch('blog_title_update', $this);
        return $this;
    }
}
```