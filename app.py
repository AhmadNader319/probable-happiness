# app.py
from flask import Flask, jsonify, request
from flask_cors import CORS
from models import tasks

app = Flask(__name__)
CORS(app)  # Enable CORS for all domains

@app.route("/")
def home():
    return jsonify({"message": "Welcome to the ToDo Task API"})

@app.route("/tasks", methods=["GET"])
def get_tasks():
    return jsonify(tasks)

@app.route("/tasks", methods=["POST"])
def add_task():
    data = request.json
    task = {
        "id": len(tasks) + 1,
        "title": data.get("title", ""),
        "done": False
    }
    tasks.append(task)
    return jsonify(task), 201

@app.route("/tasks/<int:task_id>", methods=["PUT"])
def update_task(task_id):
    data = request.json
    for task in tasks:
        if task["id"] == task_id:
            task["title"] = data.get("title", task["title"])
            task["done"] = data.get("done", task["done"])
            return jsonify(task)
    return jsonify({"error": "Task not found"}), 404

@app.route("/tasks/<int:task_id>", methods=["DELETE"])
def delete_task(task_id):
    global tasks
    tasks = [task for task in tasks if task["id"] != task_id]
    return jsonify({"message": "Task deleted"}), 200

if __name__ == "__main__":
    app.run(debug=True)
