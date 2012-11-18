// This is just to demonstrate encapsulation and closures in javascript.
// By making the user variable local to the anonymous function it's properties
// cannot be modified directly (from outside). The setters and getters are global 
// and due to closures they still have access to the user variable even after 
// it's gone out of the current scope. 

(function(){

    // our variable is now local
    var user = {name: 'Dave', age: 19};

    // make our functions global
    setName = function(name){
        if (typeof name == 'string') user.name = name;
    };

    getName = function(){
        return user.name;
    };

    setAge = function(age){
        if (typeof age == 'number') user.age = age;
    };

    getAge = function(){
        return user.age;
    };

})();

// set a new name
setName('Eric');
console.log(getName()); // 'Eric'

// set a new age
setAge(33);
console.log(getAge()); // 33