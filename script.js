fetch('https://jsonplaceholder.typicode.com/todos/1').then(
  resp => resp.json() // this returns a promise
).then(repos => {
    console.log(repos);
}).catch(ex => {
  console.error(ex);
})