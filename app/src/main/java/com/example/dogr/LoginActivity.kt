package com.example.dogr

import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import com.google.firebase.auth.FirebaseAuth
import kotlinx.android.synthetic.main.activity_login.*
import kotlinx.android.synthetic.main.activity_login.edit_text_password
import kotlinx.android.synthetic.main.activity_login.text_email
import net.simplifiedcoding.firebaseauthtutorial.utils.login
import net.simplifiedcoding.firebaseauthtutorial.utils.toast

class LoginActivity : AppCompatActivity() {

    private lateinit var mAuth: FirebaseAuth

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)


        mAuth = FirebaseAuth.getInstance()


        /*Action when the sign in button is pressed*/
        button_sign_in.setOnClickListener{

            val email = text_email.text.toString().trim()
            val password = edit_text_password.text.toString().trim()

            /*Checks if the email field is empty*/
            if(email.isEmpty())
            {
                text_email.error = "Email Required"
                text_email.requestFocus()
                return@setOnClickListener
            }


            /*Checks if the password field is empty*/
            if(password.isEmpty() || password.length < 6)
            {
                edit_text_password.error = "6 Char password required"
                edit_text_password.requestFocus()
                return@setOnClickListener
            }

            loginUser(email, password)
        }

        /*Redirects on register page*/
        text_view_register.setOnClickListener()
        {
            startActivity(Intent(this@LoginActivity, RegisterActivity::class.java))
        }
    }



    /*Method for when the login button is pressed*/
    private fun loginUser(email: String, password: String)
    {
        progressbar.visibility = View.VISIBLE

        mAuth.signInWithEmailAndPassword(email, password)
                .addOnCompleteListener(this){task ->
                    progressbar.visibility = View.GONE
                    if(task.isSuccessful)
                    {

                        login()


                    }
                    else
                    {
                        task.exception?.message?.let{
                        toast(it)
                    }
                    }
                }
    }


    /*After the login is succesfull*/
    override fun onStart() {
        super.onStart()

        mAuth.currentUser?.let{
            login()
        }
    }
}
