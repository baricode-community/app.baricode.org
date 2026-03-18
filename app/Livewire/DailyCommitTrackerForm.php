<?php

namespace App\Livewire;

use App\Models\DailyCommitTracker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DailyCommitTrackerForm extends Component
{
    public $title = '';

    public $message = '';

    public $impression = '';

    public $success_level = 5;

    public $tracked_date;

    public $tracker;

    public $isEditing = false;

    public function mount($tracker = null, $trackedDate = null)
    {
        $user = Auth::user();

        // Determine the tracked date
        if ($trackedDate) {
            $this->tracked_date = $trackedDate;
        } else {
            $this->tracked_date = now()->toDateString();
        }

        // Check if tracker is passed, otherwise check for existing entry today
        if ($tracker) {
            $this->tracker = $tracker;
            $this->title = $tracker->title;
            $this->message = $tracker->message;
            $this->impression = $tracker->impression;
            $this->success_level = $tracker->success_level;
            $this->tracked_date = $tracker->tracked_date->toDateString();
            $this->isEditing = true;
        } else {
            // Auto-check for existing entry for this date
            $existingTracker = DailyCommitTracker::where('user_id', $user->id)
                ->where('tracked_date', $this->tracked_date)
                ->first();

            if ($existingTracker) {
                $this->tracker = $existingTracker;
                $this->title = $existingTracker->title;
                $this->message = $existingTracker->message;
                $this->impression = $existingTracker->impression;
                $this->success_level = $existingTracker->success_level;
                $this->isEditing = true;
            }
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'impression' => 'required|string',
            'success_level' => 'required|integer|min:1|max:10',
        ]);

        $user = Auth::user();
        $trackedDateString = is_string($this->tracked_date)
            ? $this->tracked_date
            : $this->tracked_date->toDateString();

        try {
            if ($this->isEditing && $this->tracker) {
                // Direct update for existing tracker
                $this->tracker->update([
                    'title' => $this->title,
                    'message' => $this->message,
                    'impression' => $this->impression,
                    'success_level' => $this->success_level,
                ]);

                session()->flash('message', 'Daily commit updated successfully!');

                // Redirect to history after updating
                return redirect()->route('daily-commit-tracker.history');
            } else {
                // Create or update logic
                $existing = DailyCommitTracker::where('user_id', $user->id)
                    ->where('tracked_date', $trackedDateString)
                    ->first();

                if ($existing) {
                    $existing->update([
                        'title' => $this->title,
                        'message' => $this->message,
                        'impression' => $this->impression,
                        'success_level' => $this->success_level,
                    ]);
                    session()->flash('message', 'Daily commit updated successfully!');
                } else {
                    DailyCommitTracker::create([
                        'user_id' => $user->id,
                        'tracked_date' => $trackedDateString,
                        'title' => $this->title,
                        'message' => $this->message,
                        'impression' => $this->impression,
                        'success_level' => $this->success_level,
                    ]);
                    session()->flash('message', 'Daily commit created successfully!');
                }

                // Redirect to history after creating/updating
                return redirect()->route('daily-commit-tracker.history');
            }

            $this->resetForm();
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->title = '';
        $this->message = '';
        $this->impression = '';
        $this->tracked_date = now()->toDateString();
        $this->success_level = 5;
        $this->isEditing = false;
        $this->tracker = null;
    }

    public function render()
    {
        return view('livewire.daily-commit-tracker-form');
    }
}
