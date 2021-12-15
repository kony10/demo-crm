<template>
    <div id="right">
        <div class="navigation">
            <navbar/>
            
        </div>

        <h2>Development CRM </h2>
        <div class="horizontal">
            <img src="../images/horizontal.png" alt=""/>
        </div>

        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of
        Letraset sheets containing Lorem Ipsum passages, and more recently 
        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
        </p>

        <div class="tasks">
            
            <div class="add-tasks">
                <h3>Today's Task</h3>
                <div class="add-action"><img src="../images/add.png" alt=""/></div>
            </div>
            <ul class="tasks-list">
                <li v-for="(task, i) in todayTask" :key="task.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox" v-model="checkSelected" name="taskToday" class="taskTodayCheckbox" 
                                :checkbox="task.completed" 
                                @change="updateTodayTask(task.taskId, i)" />
                               <span></span>
                            </label>
                            <h4>{{ task.title }}</h4>
                        </div> 
                        <div class="right">
                            <img src="../images/edit.png" alt=""/>
                            <img src="../images/del.png" alt="" @click="deleteTodayTask(task.taskId)" />
                            <button v-bind:class="{
                                    inprogress: !task.completed,
                                    completed:task.completed} ">
                             {{ task.completed ? 'Completed' : 'In Progress'  }}       
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="upcoming">
            <div class="add-tasks">
                <h3>Upcoming</h3>
                <div class="add-action"><img src="../images/add.png" alt=""/></div>
            </div>

            <form action="" @submit="addUpcoming">
                <input type="text" v-model="newTask"/>
            </form>
                  
            <ul class="tasks-list">
                <li v-for="(upcomingtask , i) in upcoming" :key="upcomingtask.id" >
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox" name="test" 
                                :checkbox="upcomingtask.completed" 
                                @change="checkUpcoming(upcomingtask.taskId)" />
                                <span></span>
                            </label>
                            <h4>{{ upcomingtask.title }}</h4>
                        </div> 
                        <div class="right">
                            <img src="../images/edit.png" alt=""/>
                            <img src="../images/del.png" alt="" @click="deleteUpcoming(upcomingtask.taskId)" />
                            <button v-bind:class= "{ inprogress: !upcoming.waiting }">
                               <!-- {{ upcomingtask.waiting ? 'Waiting' : 'In Progress'  }}  !-->
                               Waiting
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            
        </div>
    </div>
</template>

<script>
import navbar from "./NavBar";

import axios from "axios";

export default {
    components:{
        navbar,
    },
    data() {
        return {
            todayTask:[],
            upcoming:[],
            newTask:"",
            checkSelected:false,
        };
    },
    
    created() {
        this.fetchTodayTasks();
        this.fetchUpcoming();  
    },
    
    methods: {

        // ** Upciming Tasks **//

        // get upcoming tasks // 2nd wat to fetch all data
        fetchUpcoming(){ 
            fetch('api/upcoming')
            .then((res) => res.json())
            .then( ({ data }) => {
                this.upcoming = data;
                // console.log(this.upcoming )
              })
            .catch( (err) => console.log(err ));
            
        },

        //Add Upcoming tasks

        addUpcoming(e) {
            e.preventDefault();
            if(this.upcoming.length > 5){
                alert("Please complete the upcoming tasks!");
            }else{
                const newTask = {
                    title: this.newTask,
                    waiting : true,
                    taskId : Math.random().toString(36).substring(7)
                };

                // Post Request
                fetch("/api/upcoming", {
                    method: "POST",
                    headers: {
                        "content-type": "application/json",
                    },
                    body: JSON.stringify(newTask),
                }).then(() => this.upcoming.push(newTask));

                // Clear or Reset New Task 
                this.newTask= "";
            }

        },

        //Delete Upcoming tasks

        deleteUpcoming(taskId) {
            if (confirm("Are you sure?")) {
                fetch( `/api/upcoming/${taskId}`, {
                    method : "delete",
                })
                .then((res) => res.json())
                .then(() => { 
                    this.upcoming = this.upcoming.filter( 
                        ({ taskId: id }) => id !== taskId 
                    );
                })
                .catch( (err) => console.log(err));
            }
        },

        //Check Upcoming tasks
        checkUpcoming(taskId) {
            if(this.upcoming.length > 5){
                alert('Sorry complete existing tasks!');
                window.location.href="/";
            }else{
                this.addDailyTask(taskId);

                // Delete this task from Database upcomings
                fetch(`api/upcoming/${taskId}`, { method: "delete"})
                .then( () =>
                 (this.upcoming = this.upcoming.filter( ({taskId: id}) => id !== taskId
                 ))
                );
            }

        },

        // ** Today Task method **//

        //get today Tasks
        fetchTodayTasks() {
            fetch("api/dailytask")
            .then((res) => res.json())
            .then( ( {data} ) => {
                this.todayTask = data ;
            })
            .catch( (err) => console.log(err));
        },

        // Add Daily Task from Upcooming selection

        addDailyTask(taskId){
            // Get Task
            const task = this.upcoming.filter(({taskId: id}) => id === taskId)[0];
            
            // Post request 

            fetch("api/dailytask", {
                method: "POST",
                headers: {
                    "content-type":  "application/json"
                },
                body: JSON.stringify(task),
                })
                .then( () => this.todayTask.unshift(task))
                .catch((err) => console.log(err));
        },

        // Delete Today Task
        deleteTodayTask(taskId) {
            if (confirm("Are you sure?")) {
                 fetch(`api/dailytask/${taskId}`, {
                method:  'delete',
                })
                .then( (res)  => res.json() )    
                .then( 
                    () => 
                    (this.todayTask =  this.todayTask.filter( 
                        ({ taskId: id }) => id !== taskId 
                    ))
                ).catch((err) => console.log(err));
            }
        },
           

        // Update Today Task
        updateTodayTask(taskId,i) {
            this.checkSelected = true;
            if(confirm('Task Complete?')){
                 
                const completedTask = {
                     completed : true
                };
                fetch(`api/dailytask/${taskId}`, {
                    method: 'PUT',
                    headers: {
                         "content-type" : "application/json"
                    },
                    body: JSON.stringify(completedTask,taskId),  
                })
                .then( () => ( this.todayTask[i].completed = completedTask ))
                .catch((err) => console.log(err));
                this.checkSelected = false;
            }
        },
        
    }, // End Methods
    
}
</script>

<style lang="">
    
</style>