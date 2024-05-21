from flask import Flask, render_template, request
from flask_mail import Mail, Message

app = Flask(__name__)

app.config.update(
    DEBUG=False,
    MAIL_SERVER='smtp.gmail.com',
    MAIL_PORT=465,
    MAIL_USE_SSL=True,
    MAIL_DEFAULT_SENDER=('輔導員', 'ntuimdorm@gmail.com'),
    MAIL_MAX_EMAILS=1000,
    MAIL_USERNAME='ntuimdorm@gmail.com',
    MAIL_PASSWORD='gogz tuip xnqm eycf'
)

mail = Mail(app)

@app.route("/index")
@app.route("/")
def index():
    return render_template('index.html')

@app.route("/api/send_mail", methods=['POST'])
def send_mail():
    emails = request.form['emails'].splitlines()  # 获取所有被输入的邮箱地址
    subject = request.form['subject']
    content = request.form['content']

    for email in emails:
        if email.strip():  # 跳过空行
            msg = Message(
                subject=subject,
                recipients=[email.strip()],
                body=content
            )
            mail.send(msg)

    return render_template("thank.html")

@app.route("/Bulk_emails")
def Bulk_emails():
    """批次寄信"""
    users = [
        {"name": "xxxxxxxxxx", "email": "xxxxxxxxxx"},
        {"name": "xxxxxxxxxx", "email": "xxxxxxxxxx"},
        {"name": "xxxxxxxxxx", "email": "xxxxxxxxxx"},
        {"name": "xxxxxxxxxx", "email": "xxxxxxxxxx"},
        {"name": "xxxxxxxxxx", "email": "xxxxxxxxxx"},
        {"name": "xxxxxxxxxx", "email": "xxxxxxxxxx"},
    ]

    with mail.connect() as conn:
        for user in users:
            subject = 'hello, {}'.format(user['name'])
            content = '這是 flask-mail example'

            msg = Message(subject=subject,
                          recipients=[user['email']],
                          body=content,
                          )
            conn.send(msg)

    return "請到你的信箱收信~ ^0^"

if __name__ == '__main__':
    app.run()
