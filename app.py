from flask import Flask, render_template, request, redirect, url_for
import random

app = Flask(__name__)
app.secret_key = "your_secret_key"

# Database simulation (replace with a real database)
users = {}
verification_tokens = {}

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/register", methods=["GET", "POST"])
def register():
    if request.method == "POST":
        email = request.form["email"]
        password = request.form["password"]
        if email in users:
            return "User already registered!"
        
        # Generate a random verification token (for simplicity)
        token = str(random.randint(1000, 9999))
        verification_tokens[email] = token

        # Simulate sending verification email (print token in real case)
        print(f"Verification token for {email}: {token}")

        users[email] = password
        return redirect(url_for("verify_email"))
    
    return render_template("register.html")

@app.route("/verify_email")
def verify_email():
    return render_template("verify_email.html")

@app.route("/login", methods=["GET", "POST"])
def login():
    if request.method == "POST":
        email = request.form["email"]
        password = request.form["password"]
        if email in users and users[email] == password:
            return redirect(url_for("dashboard"))
        else:
            return "Invalid login credentials"
    
    return render_template("login.html")

@app.route("/dashboard")
def dashboard():
    return render_template("dashboard.html")

if __name__ == "__main__":
    app.run(debug=True)
