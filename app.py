from flask import Flask, jsonify, request
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

tasks = []
task_id = 1

@app.route("/")
def home():
    return jsonify({"message": "Welcome to the Flask Todo API"}), 200

@app.route("/tasks", methods=["GET"])
def get_tasks():
    return jsonify(tasks), 200

@app.route("/tasks", methods=["POST"])
def add_task():
    global task_id
    data = request.get_json()
    task = {
        "id": task_id,
        "title": data.get("title", ""),
        "completed": False
    }
    tasks.append(task)
    task_id += 1
    return jsonify(task), 201

@app.route("/tasks/<int:task_id_param>", methods=["PUT"])
def update_task(task_id_param):
    data = request.get_json()
    for task in tasks:
        if task["id"] == task_id_param:
            task["title"] = data.get("title", task["title"])
            task["completed"] = data.get("completed", task["completed"])
            return jsonify(task), 200
    return jsonify({"error": "Task not found"}), 404

@app.route("/tasks/<int:task_id_param>", methods=["DELETE"])
def delete_task(task_id_param):
    global tasks
    tasks = [task for task in tasks if task["id"] != task_id_param]
    return jsonify({"message": "Task deleted"}), 200

if __name__ == "__main__":
    app.run(debug=True)
